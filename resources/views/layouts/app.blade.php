<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <title>Admin - DARRO</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>body{padding-top:70px}</style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">DARRO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="{{ route('superadmin.pending.users') }}">Pending users</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('super.admin.dashboard') }}">Dashboard</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container">
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Inactivity warning modal -->
  <div class="modal fade" id="inactivityWarningModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">You're about to be signed out</h5>
        </div>
        <div class="modal-body">
          <p>You have been inactive. You will be automatically logged out in <strong id="inactivity-countdown">10</strong> seconds.</p>
        </div>
        <div class="modal-footer">
          <button type="button" id="staySignedInBtn" class="btn btn-primary">Stay signed in</button>
          <button type="button" id="logoutNowBtn" class="btn btn-secondary">Log out now</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function(){
      const INACTIVITY_MS = 60 * 1000; // 1 minute
      const WARNING_MS = 10 * 1000;    // 10 seconds

      let idleTimer = null;
      let warningTimeout = null;
      let countdownInterval = null;
      let performedLogout = false;

      const modalEl = document.getElementById('inactivityWarningModal');
      const countdownEl = document.getElementById('inactivity-countdown');
      const stayBtn = document.getElementById('staySignedInBtn');
      const logoutNowBtn = document.getElementById('logoutNowBtn');
      const bsModal = modalEl ? new bootstrap.Modal(modalEl, {backdrop: 'static', keyboard: false}) : null;

      function getCsrfToken(){
        const m = document.querySelector('meta[name="csrf-token"]');
        return m ? m.getAttribute('content') : '';
      }

      async function performLogout(){
        if(performedLogout) return;
        performedLogout = true;
        const token = getCsrfToken();
        try {
          await fetch("{{ route('logout') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
            credentials: 'same-origin',
            body: JSON.stringify({})
          });
        } catch(e) {}
        window.location.href = "{{ url('/login') }}";
      }

      function clearWarningTimers(){
        if(warningTimeout) { clearTimeout(warningTimeout); warningTimeout = null; }
        if(countdownInterval) { clearInterval(countdownInterval); countdownInterval = null; }
      }

      function showWarning(){
        if(!bsModal) return performLogout();
        let secondsLeft = Math.ceil(WARNING_MS / 1000);
        if(countdownEl) countdownEl.textContent = secondsLeft;
        bsModal.show();
        countdownInterval = setInterval(() => {
          secondsLeft--;
          if(countdownEl) countdownEl.textContent = secondsLeft <= 0 ? 0 : secondsLeft;
          if(secondsLeft <= 0) { clearWarningTimers(); }
        }, 1000);
        warningTimeout = setTimeout(() => { clearWarningTimers(); if(bsModal) bsModal.hide(); performLogout(); }, WARNING_MS);
      }

      function hideWarning(){ if(bsModal) bsModal.hide(); clearWarningTimers(); }

      function resetIdleTimer(){
        if(idleTimer) { clearTimeout(idleTimer); idleTimer = null; }
        hideWarning();
        idleTimer = setTimeout(showWarning, Math.max(0, INACTIVITY_MS - WARNING_MS));
      }

      ['mousemove','keydown','mousedown','touchstart','scroll'].forEach(evt => document.addEventListener(evt, resetIdleTimer, { passive: true }));

      if(stayBtn) stayBtn.addEventListener('click', () => { hideWarning(); resetIdleTimer(); });
      if(logoutNowBtn) logoutNowBtn.addEventListener('click', () => { clearWarningTimers(); if(bsModal) bsModal.hide(); performLogout(); });

      // start
      resetIdleTimer();
    })();
  </script>
  @if(session('swal'))
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const _swal = @json(session('swal'));
        if (typeof Swal !== 'undefined' && _swal) Swal.fire(_swal);
      });
    </script>
  @endif
</body>
</html>
