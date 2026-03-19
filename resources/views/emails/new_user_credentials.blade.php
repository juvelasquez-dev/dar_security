<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Your account credentials</title>
    <style>
        body { font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; color:#222; }
        .card { max-width:600px; margin:0 auto; padding:20px; border:1px solid #eee; border-radius:8px; background:#fff }
        .btn { display:inline-block; padding:10px 14px; background:#1f803c; color:#fff; border-radius:6px; text-decoration:none }
        .muted { color:#6b7280 }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="margin-top:0">Your account has been created</h2>
        <p class="muted">Hello {{ $user->first_name ?? $user->name }},</p>

        <p>An account has been created for you. Use the credentials below to sign in:</p>

        <p>
            <strong>Email / Username:</strong> {{ $user->email ?? $user->username }}<br>
            <strong>Password:</strong> {{ $password }}
        </p>

        <p>You can sign in here: <a class="btn" href="{{ url('/') }}">Open site</a></p>

        <hr>
        <p class="muted" style="font-size:.9rem">If you did not request this account, please contact your system administrator.</p>
    </div>
</body>
</html>
