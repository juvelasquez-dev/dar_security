<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Verify – DARRO 5</title>

  <link rel="icon" href="{{ asset('images/dar-logo.png') }}" type="image/png">
  <link rel="apple-touch-icon" href="{{ asset('images/dar-logo.png') }}">
  <meta property="og:image" content="{{ asset('images/dar-logo.png') }}">

  <!-- Bootstrap 5.3.3 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    :root {
      --brand-primary: #0d6efd;
      --brand-primary-dark: #0a58ca;
    }

    body {
      background: linear-gradient(135deg, #f8f9fc 0%, #e9f0ff 100%);
      min-height: 100vh;
      font-feature-settings: "liga" 1, "calt" 1;
    }

    [data-bs-theme="dark"] body {
      background: linear-gradient(135deg, #0d1117 0%, #161b22 100%);
    }

    .login-container {
      max-width: 440px;
      width: 100%;
    }

    .brand-circle {
      width: 90px;
      height: 90px;
      background: transparent;
      border: 6px solid rgba(13, 110, 253, 0.18);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 32px rgba(13, 110, 253, 0.12);
    }

    .brand-logo {
      max-width: 68%;
      max-height: 68%;
      object-fit: contain;
      display: block;
    }

    .card {
      border: none;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 16px 48px rgba(0,0,0,0.10);
      backdrop-filter: blur(8px);
    }

    [data-bs-theme="dark"] .card {
      background: #161b22;
      box-shadow: 0 16px 48px rgba(0,0,0,0.6);
    }

    .form-control, .form-control:focus {
      background: rgba(255,255,255,0.7);
      border-radius: 10px;
    }

    [data-bs-theme="dark"] .form-control,
    [data-bs-theme="dark"] .form-control:focus {
      background: rgba(40,45,55,0.7);
      color: #e6edf3;
    }

    .btn-primary {
      border-radius: 10px;
      padding: 0.75rem 1.5rem;
      font-weight: 600;
    }

    .theme-toggle {
      position: fixed;
      top: 1rem;
      right: 1rem;
      z-index: 1000;
    }

    /* OTP input row */
    .otp-inputs {
      display: flex;
      gap: 10px;
      justify-content: center;
    }

    .otp-inputs input {
      width: 52px;
      height: 58px;
      font-size: 1.5rem;
      font-weight: 700;
      text-align: center;
      border-radius: 12px;
      border: 1.5px solid #dee2e6;
      background: rgba(255,255,255,0.7);
      transition: border-color 0.15s, box-shadow 0.15s;
      caret-color: var(--brand-primary);
    }

    [data-bs-theme="dark"] .otp-inputs input {
      background: rgba(40,45,55,0.7);
      color: #e6edf3;
      border-color: rgba(255,255,255,0.1);
    }

    .otp-inputs input:focus {
      border-color: var(--brand-primary);
      box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.18);
      outline: none;
    }

    .otp-inputs input.is-invalid {
      border-color: #dc3545;
      box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15);
    }

    /* Shield icon badge */
    .shield-badge {
      width: 56px;
      height: 56px;
      background: rgba(13, 110, 253, 0.08);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
    }

    /* Resend link */
    #resendTimer {
      font-variant-numeric: tabular-nums;
    }

    .back-link {
      color: #6c757d;
      text-decoration: none;
      font-size: 0.875rem;
      transition: color .15s;
    }

    .back-link:hover {
      color: var(--brand-primary);
    }

    /* Hidden real input (we compose value from OTP boxes) */
    #code {
      display: none;
    }
  </style>
</head>

<body class="d-flex align-items-center">

  <!-- Theme toggle -->
  <div class="theme-toggle">
    <button class="btn btn-sm btn-outline-secondary rounded-pill" id="themeToggle" title="Toggle dark mode">
      <i class="bi bi-moon-stars-fill"></i>
    </button>
  </div>

  <div class="container login-container mx-auto py-5">

    <div class="card shadow-xl">
      <div class="card-body p-4 p-md-5">

        <!-- Header -->
        <div class="text-center mb-5">
          <div class="brand-circle rounded-circle mx-auto mb-4">
            <img src="{{ asset('images/dar-logo.png') }}" alt="Company logo" class="brand-logo">
          </div>
          <div class="shield-badge">
            <i class="bi bi-shield-lock-fill text-primary fs-4"></i>
          </div>
          <h4 class="fw-bold mb-1">Two-step verification</h4>
          <p class="text-muted mb-0">Enter the 6-digit code sent to your email</p>
        </div>

        <form method="POST" action="{{ route('login.verify.post') }}" class="needs-validation" novalidate id="verifyForm">
          @csrf

          {{-- Hidden real input that gets composed from OTP boxes --}}
          <input type="hidden" name="code" id="code">

          <!-- OTP boxes -->
          <div class="mb-4">
            <div class="otp-inputs" id="otpInputs">
              <input type="text" inputmode="numeric" maxlength="1" class="otp-digit" autocomplete="one-time-code" autofocus>
              <input type="text" inputmode="numeric" maxlength="1" class="otp-digit">
              <input type="text" inputmode="numeric" maxlength="1" class="otp-digit">
              <input type="text" inputmode="numeric" maxlength="1" class="otp-digit">
              <input type="text" inputmode="numeric" maxlength="1" class="otp-digit">
              <input type="text" inputmode="numeric" maxlength="1" class="otp-digit">
            </div>
            <div class="invalid-feedback text-center d-block mt-2" id="otpError" style="display:none!important;"></div>
          </div>

          <!-- Submit -->
          <div class="d-grid mb-4">
            <button class="btn btn-primary btn-lg fw-semibold" type="submit" id="verifyBtn" disabled>
              Verify Code
            </button>
          </div>

          <!-- Resend -->
          <div class="text-center small text-muted mb-3">
            Didn't receive a code?
            <span id="resendWrapper">
              <span id="resendTimer" class="fw-medium">Resend in <span id="countdown">60</span>s</span>
              <a href="#" id="resendLink" class="text-primary fw-medium text-decoration-none d-none">Resend code</a>
            </span>
          </div>

          <!-- Back to login -->
          <div class="text-center">
            <a href="{{ route('login') }}" class="back-link">
              <i class="bi bi-arrow-left me-1"></i>Back to sign in
            </a>
          </div>

        </form>

      </div>
    </div>

  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
          crossorigin="anonymous"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if (session('swal'))
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      Swal.fire(@json(session('swal')));
    });
  </script>
  @endif

  @if ($errors->any())
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const first = `{{ addslashes($errors->first()) }}`;
      Swal.fire({ icon: 'error', title: 'Invalid Code', text: first });
    });
  </script>
  @endif

  <script>
    // ── OTP input behaviour ──────────────────────────────────────────────────
    const digits    = Array.from(document.querySelectorAll('.otp-digit'));
    const codeInput = document.getElementById('code');
    const verifyBtn = document.getElementById('verifyBtn');
    const otpError  = document.getElementById('otpError');

    function getCode() {
      return digits.map(d => d.value).join('');
    }

    function updateHidden() {
      const val = getCode();
      codeInput.value = val;
      verifyBtn.disabled = val.length < 6;
      // clear error styling when user types
      digits.forEach(d => d.classList.remove('is-invalid'));
      otpError.style.setProperty('display', 'none', 'important');
    }

    digits.forEach((input, i) => {
      input.addEventListener('input', e => {
        // allow only digits
        input.value = input.value.replace(/\D/g, '').slice(-1);
        if (input.value && i < digits.length - 1) {
          digits[i + 1].focus();
        }
        updateHidden();
      });

      input.addEventListener('keydown', e => {
        if (e.key === 'Backspace' && !input.value && i > 0) {
          digits[i - 1].focus();
          digits[i - 1].value = '';
          updateHidden();
        }
        if (e.key === 'ArrowLeft' && i > 0)  digits[i - 1].focus();
        if (e.key === 'ArrowRight' && i < digits.length - 1) digits[i + 1].focus();
      });

      // handle paste on any digit box
      input.addEventListener('paste', e => {
        e.preventDefault();
        const pasted = (e.clipboardData || window.clipboardData)
          .getData('text').replace(/\D/g, '').slice(0, 6);
        pasted.split('').forEach((ch, j) => {
          if (digits[j]) digits[j].value = ch;
        });
        const next = Math.min(pasted.length, digits.length - 1);
        digits[next].focus();
        updateHidden();
      });
    });

    // ── Form submit validation ───────────────────────────────────────────────
    document.getElementById('verifyForm').addEventListener('submit', e => {
      const val = getCode();
      if (val.length < 6 || !/^\d{6}$/.test(val)) {
        e.preventDefault();
        digits.forEach(d => d.classList.add('is-invalid'));
        otpError.textContent = 'Please enter all 6 digits.';
        otpError.style.removeProperty('display');
      }
    });

    // ── Resend countdown ─────────────────────────────────────────────────────
    let seconds = 60;
    const countdownEl = document.getElementById('countdown');
    const resendTimer = document.getElementById('resendTimer');
    const resendLink  = document.getElementById('resendLink');

    const timer = setInterval(() => {
      seconds--;
      countdownEl.textContent = seconds;
      if (seconds <= 0) {
        clearInterval(timer);
        resendTimer.classList.add('d-none');
        resendLink.classList.remove('d-none');
      }
    }, 1000);

    resendLink.addEventListener('click', e => {
      e.preventDefault();
      const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      resendLink.classList.add('d-none');
      resendTimer.classList.remove('d-none');
      seconds = 60;
      countdownEl.textContent = seconds;

      // restart timer
      const t2 = setInterval(() => {
        seconds--;
        countdownEl.textContent = seconds;
        if (seconds <= 0) {
          clearInterval(t2);
          resendTimer.classList.add('d-none');
          resendLink.classList.remove('d-none');
        }
      }, 1000);

      fetch('{{ url('/login/resend-code') }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json' }
      })
      .then(r => r.json())
      .then(body => {
        Swal.fire({ icon: 'success', title: 'Code sent', text: body.message || 'A new code has been sent to your email.' });
      })
      .catch(() => {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to resend code. Please try again.' });
      });
    });

    // ── Dark mode toggle ─────────────────────────────────────────────────────
    document.getElementById('themeToggle')?.addEventListener('click', () => {
      const html = document.documentElement;
      html.setAttribute('data-bs-theme', html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark');
    });
  </script>

</body>
</html>