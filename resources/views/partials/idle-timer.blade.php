<!-- Idle session timeout partial -->
<div class="modal fade" id="inactivityWarningModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">You're about to be signed out</h5>
      </div>
      <div class="modal-body">
        <p class="mb-2">We've detected inactivity and will sign you out for security.</p>
        <p class="mb-0">You will be logged out in <strong id="inactivity-countdown">10</strong> seconds.</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="staySignedInBtn" class="btn btn-outline-primary">Stay signed in</button>
        <button type="button" id="logoutNowBtn" class="btn btn-danger">Log out now</button>
      </div>
    </div>
  </div>
</div>

<!-- Hidden logout form (fallback) -->
<form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const INACTIVITY_MS = 15 * 60 * 1000; // 15 minutes
    const WARNING_MS = 10 * 1000; // 10 seconds warning
    const DEBUG = true;

    let lastActivity = Date.now();
    let warningShown = false;
    let performedLogout = false;
    let countdownInterval = null;
    let warningTimeout = null;
    let checkInterval = null;

    const modalEl = document.getElementById('inactivityWarningModal');
    const countdownEl = document.getElementById('inactivity-countdown');
    const stayBtn = document.getElementById('staySignedInBtn');
    const logoutNowBtn = document.getElementById('logoutNowBtn');
    const logoutForm = document.getElementById('logoutForm');

    const bsModal = (modalEl && typeof bootstrap !== 'undefined') ? new bootstrap.Modal(modalEl, { backdrop: 'static', keyboard: false }) : null;

    function log(){ if(DEBUG) console.log.apply(console, ['[idle-timer]'].concat(Array.from(arguments))); }

    function getCsrfToken(){
        return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    }

    async function performLogout(){
        if(performedLogout) return;
        performedLogout = true;
        log('performLogout');

        const token = getCsrfToken();

        try {
            await fetch("{{ route('logout') }}", {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ _token: token })
            });
        } catch (e) {
            log('fetch logout failed, falling back to form submit', e);
            try { logoutForm && logoutForm.submit(); } catch(e2){ log('form submit failed', e2); }
        }

        window.location.href = "{{ url('/login') }}";
    }

    function clearTimers(){
        if(countdownInterval){ clearInterval(countdownInterval); countdownInterval = null; }
        if(warningTimeout){ clearTimeout(warningTimeout); warningTimeout = null; }
    }

    function showWarning(){
        if(warningShown || performedLogout) return;
        if(!bsModal){ log('Bootstrap modal not available, logging out'); return performLogout(); }

        warningShown = true;
        clearTimers();

        let secondsLeft = Math.ceil(WARNING_MS / 1000);
        if(countdownEl) countdownEl.textContent = secondsLeft;
        bsModal.show();
        log('warning shown, countdown', secondsLeft);

        countdownInterval = setInterval(()=>{
            secondsLeft--;
            if(countdownEl) countdownEl.textContent = secondsLeft;
            log('countdown', secondsLeft);
            if(secondsLeft <= 0){
                clearTimers();
                try{ bsModal.hide(); }catch(e){}
                performLogout();
            }
        }, 1000);

        // backup timeout
        warningTimeout = setTimeout(()=>{
            log('warningTimeout fallback');
            clearTimers();
            try{ bsModal.hide(); }catch(e){}
            performLogout();
        }, WARNING_MS + 500);
    }

    function hideWarning(){
        if(!warningShown) return;
        log('hideWarning by user');
        warningShown = false;
        clearTimers();
        try{ bsModal.hide(); }catch(e){}
    }

    function markActivity(e){
        if(e && e.isTrusted === false) return;
        if(performedLogout) return;
        if(warningShown){ log('activity ignored while warning shown'); return; }
        lastActivity = Date.now();
        log('activity -> reset lastActivity');
    }

    ['mousemove','keydown','mousedown','touchstart','scroll'].forEach(evt => {
        document.addEventListener(evt, markActivity, { passive: true });
    });

    function checkIdle(){
        if(performedLogout || warningShown) return;
        const idleTime = Date.now() - lastActivity;
        const threshold = INACTIVITY_MS - WARNING_MS;
        log('idle check', { idleTime, threshold });
        if(idleTime >= threshold){ showWarning(); }
    }

    // periodic check
    checkInterval = setInterval(checkIdle, 1000);

    // buttons
    stayBtn && stayBtn.addEventListener('click', ()=>{
        log('stay signed in clicked');
        lastActivity = Date.now();
        hideWarning();
    });

    logoutNowBtn && logoutNowBtn.addEventListener('click', ()=>{
        log('logout now clicked');
        clearTimers();
        try{ bsModal.hide(); }catch(e){}
        performLogout();
    });

    // initialize
    lastActivity = Date.now();
    log('idle timer initialized');
});
</script>
