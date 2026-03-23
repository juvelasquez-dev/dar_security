<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reset Password</title>
  <link rel="icon" href="{{ asset('images/dar-logo.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center">
  <div class="container mx-auto py-5" style="max-width:480px;">
    <div class="card">
      <div class="card-body p-4">
        <h4 class="mb-3">Reset password</h4>
        <form method="POST" action="{{ route('password.update') }}">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          <div class="mb-3 form-floating">
            <input type="email" name="email" value="{{ old('email', $email) }}" class="form-control" id="email" placeholder="name@example.com" required>
            <label for="email">Email address</label>
          </div>

          <div class="mb-3 form-floating">
            <input type="password" name="password" class="form-control" id="password" placeholder="New password" required>
            <label for="password">New password</label>
          </div>

          <div class="mb-3 form-floating">
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password" required>
            <label for="password_confirmation">Confirm password</label>
          </div>

          <div class="d-grid">
            <button class="btn btn-primary" type="submit">Reset Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
