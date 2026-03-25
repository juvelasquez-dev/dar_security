<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Reset Password – DARRO 5</title>

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

    /* Hide browser's native password reveal button */
    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear,
    input[type="password"]::-webkit-contacts-auto-fill-button,
    input[type="password"]::-webkit-credentials-auto-fill-button {
      display: none !important;
      visibility: hidden;
      pointer-events: none;
    }

    .password-wrapper {
      position: relative;
    }

    .password-wrapper .toggle-password {
      position: absolute;
      top: 50%;
      right: 0;
      transform: translateY(-50%);
      z-index: 10;
      padding-right: 1rem;
      background: none;
      border: none;
      line-height: 1;
    }

    /* Password strength bar */
    .strength-bar {
      height: 4px;
      border-radius: 2px;
      background: #e9ecef;
      overflow: hidden;
      margin-top: 6px;
    }

    .strength-fill {
      height: 100%;
      border-radius: 2px;
      width: 0%;
      transition: width .3s ease, background-color .3s ease;
    }

    .back-link {
      color: #6c757d;
      text-decoration: none;
      font-size: 0.875rem;
      transition: color .15s;
    }

    .back-link:hover { color: var(--brand-primary); }

    /* Key icon badge */
    .key-badge {
      width: 56px;
      height: 56px;
      background: rgba(13, 110, 253, 0.08);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
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
          <div class="key-badge">
            <i class="bi bi-key-fill text-primary fs-4"></i>
          </div>
          <h4 class="fw-bold mb-1">Set new password</h4>
          <p class="text-muted mb-0">Must be at least 8 characters long</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate>
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          <!-- Email -->
          <div class="mb-4 form-floating">
            <input type="email" name="email" value="{{ old('email', $email) }}"
                   class="form-control" id="email" placeholder="name@example.com" required>
            <label for="email">Email address</label>
            <div class="invalid-feedback">Please enter a valid email address.</div>
          </div>

          <!-- New Password -->
          <div class="mb-1 password-wrapper">
            <div class="form-floating">
              <input type="password" name="password" class="form-control pe-5"
                     id="password" placeholder="New password" required autocomplete="new-password">
              <label for="password">New password</label>
              <div class="invalid-feedback">Password is required.</div>
            </div>
            <button type="button" class="toggle-password" tabindex="-1" aria-label="Toggle password visibility">
              <i class="bi bi-eye fs-5 text-muted"></i>
            </button>
          </div>

          <!-- Strength bar -->
          <div class="strength-bar mb-4">
            <div class="strength-fill" id="strengthFill"></div>
          </div>

          <!-- Confirm Password -->
          <div class="mb-4 password-wrapper">
            <div class="form-floating">
              <input type="password" name="password_confirmation" class="form-control pe-5"
                     id="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
              <label for="password_confirmation">Confirm password</label>
              <div class="invalid-feedback" id="confirmFeedback">Passwords do not match.</div>
            </div>
            <button type="button" class="toggle-password" tabindex="-1" aria-label="Toggle password visibility">
              <i class="bi bi-eye fs-5 text-muted"></i>
            </button>
          </div>

          <!-- Submit -->
          <div class="d-grid mb-4">
            <button class="btn btn-primary btn-lg fw-semibold" type="submit">
              Reset Password
            </button>
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
      Swal.fire({ icon: 'error', title: 'Error', text: first });
    });
  </script>
  @endif

  <script>
    // ── Password visibility toggles ──────────────────────────────────────────
    document.querySelectorAll('.toggle-password').forEach(btn => {
      btn.addEventListener('click', () => {
        const input = btn.closest('.password-wrapper').querySelector('input');
        const icon  = btn.querySelector('i');
        if (input.type === 'password') {
          input.type = 'text';
          icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
          input.type = 'password';
          icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
      });
    });

    // ── Password strength meter ──────────────────────────────────────────────
    const passwordInput = document.getElementById('password');
    const strengthFill  = document.getElementById('strengthFill');

    function calcStrength(pwd) {
      let score = 0;
      if (pwd.length >= 8)  score++;
      if (pwd.length >= 12) score++;
      if (/[A-Z]/.test(pwd)) score++;
      if (/[0-9]/.test(pwd)) score++;
      if (/[^A-Za-z0-9]/.test(pwd)) score++;
      return score; // 0–5
    }

    passwordInput.addEventListener('input', () => {
      const score = calcStrength(passwordInput.value);
      const pct   = (score / 5) * 100;
      const colors = ['#dc3545', '#dc3545', '#fd7e14', '#ffc107', '#198754', '#198754'];
      strengthFill.style.width = pct + '%';
      strengthFill.style.backgroundColor = colors[score] || '#e9ecef';
    });

    // ── Confirm password match ───────────────────────────────────────────────
    const confirmInput   = document.getElementById('password_confirmation');
    const confirmFeedback = document.getElementById('confirmFeedback');

    confirmInput.addEventListener('input', () => {
      if (confirmInput.value && confirmInput.value !== passwordInput.value) {
        confirmInput.classList.add('is-invalid');
      } else {
        confirmInput.classList.remove('is-invalid');
      }
    });

    // ── Bootstrap client-side validation ────────────────────────────────────
    (() => {
      'use strict';
      document.querySelectorAll('.needs-validation').forEach(form => {
        form.addEventListener('submit', e => {
          // extra check: passwords must match
          if (passwordInput.value !== confirmInput.value) {
            confirmInput.classList.add('is-invalid');
            e.preventDefault();
            e.stopPropagation();
          }
          if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();

    // ── Dark mode toggle ─────────────────────────────────────────────────────
    document.getElementById('themeToggle')?.addEventListener('click', () => {
      const html = document.documentElement;
      html.setAttribute('data-bs-theme', html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark');
    });
  </script>

</body>
</html>