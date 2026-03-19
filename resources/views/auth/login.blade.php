<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign In – Acme</title>

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

    .btn-social {
      height: 40px;
      border-radius: 10px;
      font-weight: 500;
      border-width: 1px;
      transition: transform .12s ease, box-shadow .12s ease, background-color .12s ease;
    }

    .btn-google {
      background: white;
      border-color: #dadce0;
      color: #000;
    }

    .social-btns-row {
      display: flex;
      gap: 12px;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
    }

    .social-btn-wrap {
      width: 48%;
      flex: 0 0 48%;
      max-width: 220px;
    }

    @media (max-width: 576px) {
      .social-btn-wrap { width: 100%; flex: 0 0 100%; }
      .social-btns-row { gap: 12px; }
    }

    .btn-apple {
      background: #000;
      color: white;
      border-color: #000;
    }

    .btn-facebook {
      background: #00A4EF;
      border-color: #00A4EF;
      color: white;
    }

    .btn-microsoft {
      background: transparent;
      border-color: #0078D7;
      color: #0078D7;
    }

    .btn-microsoft:hover,
    .btn-microsoft:focus {
      background: transparent;
      border-color: #005A9E;
      color: #005A9E;
      box-shadow: 0 8px 24px rgba(0, 90, 158, 0.12);
      text-decoration: none;
    }

    .or-divider {
      position: relative;
      text-align: center;
      color: #6c757d;
    }

    .or-divider::before,
    .or-divider::after {
      content: "";
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      height: 1px;
      background: currentColor;
      opacity: 0.25;
      z-index: 1;
    }

    .or-divider > .px-3 {
      position: relative;
      z-index: 2;
      display: inline-block;
      padding: 0 .75rem;
    }

    .or-divider::before { left: 0; right: 50%; margin-right: .75rem; }
    .or-divider::after  { right: 0; left: 50%; margin-left: .75rem; }

    .theme-toggle {
      position: fixed;
      top: 1rem;
      right: 1rem;
      z-index: 1000;
    }

    /* ✅ FIX: Hide browser's native password reveal button */
    input[type="password"]::-ms-reveal,
    input[type="password"]::-ms-clear,
    input[type="password"]::-webkit-contacts-auto-fill-button,
    input[type="password"]::-webkit-credentials-auto-fill-button {
      display: none !important;
      visibility: hidden;
      pointer-events: none;
    }

    /* ✅ FIX: Ensure toggle button sits cleanly over the input */
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
  </style>
</head>

<body class="d-flex align-items-center">

  <!-- Optional theme toggle (demo) -->
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
          <h4 class="fw-bold mb-1">Welcome back</h4>
          <p class="text-muted mb-0">Sign in to continue to DARRO 5</p>
        </div>
  {{-- SweetAlert2 will display errors/messages --}}
        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
@csrf

          <!-- Email -->
          <div class="mb-4 form-floating">
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required autofocus>
            <label for="email">Email address</label>
            <div class="invalid-feedback">Please enter a valid email address.</div>
          </div>

          <!-- ✅ FIXED: Password + toggle — wrapper outside form-floating -->
          <div class="mb-4 password-wrapper">
            <div class="form-floating">
              <input type="password" name="password" class="form-control pe-5" id="password" placeholder="Password" required autocomplete="current-password">
              <label for="password">Password</label>
              <div class="invalid-feedback">Password is required.</div>
            </div>
            <button type="button" class="toggle-password" tabindex="-1" aria-label="Toggle password visibility">
              <i class="bi bi-eye fs-5 text-muted"></i>
            </button>
          </div>

          <!-- Remember & Forgot -->
          <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 gap-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember" value="remember">
              <label class="form-check-label small" for="remember">Stay signed in</label>
            </div>
            <a href="#" class="small text-decoration-none">Forgot password?</a>
          </div>

          <!-- Submit -->
          <div class="d-grid mb-4">
            <button class="btn btn-primary btn-lg fw-semibold" type="submit">
              Sign In
            </button>
          </div>

          <!-- Divider -->
          <div class="or-divider my-4">
            <span class="px-3 bg-body position-relative">or continue with</span>
          </div>

          <!-- Social buttons -->
          <div class="mb-4">
            <div class="social-btns-row justify-content-center">
              <div class="social-btn-wrap">
                <a href="{{ url('/auth/google') }}" class="btn btn-google btn-social w-100 text-center">
                  <i class="bi bi-google me-2"></i>Google
                </a>
              </div>
              <div class="social-btn-wrap">
                <button type="button" class="btn btn-microsoft btn-social w-100 text-center">
                  <i class="bi bi-microsoft me-2"></i>Microsoft
                </button>
              </div>
            </div>
          </div>

          <!-- Sign up link -->
          <div class="text-center small text-muted">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-primary fw-medium text-decoration-none">Register</a>
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
    // Password visibility toggle
    document.querySelectorAll('.toggle-password').forEach(btn => {
      btn.addEventListener('click', () => {
        const input = btn.closest('.password-wrapper').querySelector('input');
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
          input.type = 'text';
          icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
          input.type = 'password';
          icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
      });
    });

    // Bootstrap client-side validation
    (() => {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', e => {

          if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();

    // Dark mode toggle
    document.getElementById('themeToggle')?.addEventListener('click', () => {
      const html = document.documentElement;
      const current = html.getAttribute('data-bs-theme');
      html.setAttribute('data-bs-theme', current === 'dark' ? 'light' : 'dark');
    });
  </script>

</body>
</html>