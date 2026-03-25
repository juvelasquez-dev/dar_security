<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Verification Code – DARRO 5</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
    img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }

    body {
      background-color: #f4fce8;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      color: #1a2e0a;
    }

    .email-wrapper {
      width: 100%;
      background-color: #f4fce8;
      padding: 40px 16px;
    }

    .email-card {
      max-width: 520px;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 16px 48px rgba(34, 139, 34, 0.12);
    }

    /* Header */
    .email-header {
      background: linear-gradient(135deg, #4caf27 0%, #2e7d0e 100%);
      padding: 36px 40px 32px;
      text-align: center;
    }

    .header-title {
      color: #ffffff;
      font-size: 22px;
      font-weight: 700;
      letter-spacing: -0.3px;
      margin: 0;
    }

    .header-subtitle {
      color: rgba(255,255,255,0.85);
      font-size: 14px;
      margin-top: 4px;
    }

    /* Body */
    .email-body {
      padding: 36px 40px;
    }

    .greeting {
      font-size: 16px;
      color: #374151;
      margin-bottom: 12px;
    }

    .body-text {
      font-size: 15px;
      color: #6b7280;
      line-height: 1.6;
      margin-bottom: 28px;
    }

    /* OTP block */
    .otp-block {
      background: #f4fce8;
      border: 1.5px solid #bbf7a0;
      border-radius: 14px;
      padding: 28px 24px;
      text-align: center;
      margin-bottom: 28px;
    }

    .otp-label {
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      color: #2e7d0e;
      margin-bottom: 16px;
    }

    .otp-code {
      font-size: 42px;
      font-weight: 700;
      letter-spacing: 10px;
      color: #1a2e0a;
      font-family: 'Courier New', Courier, monospace;
      margin-bottom: 14px;
    }

    .otp-expiry {
      font-size: 13px;
      color: #9ca3af;
    }

    .otp-expiry span {
      color: #e65c00;
      font-weight: 600;
    }

    /* Divider */
    .divider {
      border: none;
      border-top: 1px solid #e5e7eb;
      margin: 28px 0;
    }

    /* Warning box */
    .warning-box {
      background: #fffde7;
      border-left: 4px solid #f5c800;
      border-radius: 0;
      padding: 14px 16px;
      font-size: 13.5px;
      color: #6b4c00;
      line-height: 1.5;
      margin-bottom: 24px;
    }

    .warning-box strong { color: #4a3300; }

    /* Sign off */
    .sign-off {
      font-size: 15px;
      color: #6b7280;
      line-height: 1.6;
    }

    .sign-off strong { color: #374151; }

    /* Footer */
    .email-footer {
      background: #f4fce8;
      border-top: 1px solid #bbf7a0;
      padding: 24px 40px;
      text-align: center;
    }

    .footer-app-name {
      font-size: 13px;
      font-weight: 700;
      color: #2e7d0e;
      letter-spacing: 0.5px;
      margin-bottom: 4px;
    }

    .footer-text {
      font-size: 12px;
      color: #9ca3af;
      line-height: 1.5;
    }

    .footer-text a { color: #2e7d0e; text-decoration: none; }

    @media only screen and (max-width: 560px) {
      .email-body  { padding: 28px 24px; }
      .email-header { padding: 28px 24px 24px; }
      .email-footer { padding: 20px 24px; }
      .otp-block { padding: 22px 16px; }
      .otp-code { font-size: 34px; letter-spacing: 6px; }
    }
  </style>
</head>
<body>

  <div class="email-wrapper">
    <div class="email-card">

      <!-- Header -->
      <div class="email-header">
        <p class="header-title">DARRO 5</p>
        <p class="header-subtitle">E-Agraryo Merkado Team</p>
      </div>

      <!-- Body -->
      <div class="email-body">

        <p class="greeting">Hi <strong>{{ $user->first_name ?? $user->name ?? 'User' }}</strong>,</p>

        <p class="body-text">
          We received a login request for your account. Use the verification code below to complete your sign-in.
          Do not share this code with anyone.
        </p>

        <!-- OTP Block -->
        <div class="otp-block">
          <p class="otp-label">Your verification code</p>
          <p class="otp-code">{{ $code }}</p>
          <p class="otp-expiry">Expires in <span>10 minutes</span></p>
        </div>

        <hr class="divider">

        <!-- Warning -->
        <div class="warning-box">
          <strong>Didn't request this?</strong> If you did not attempt to sign in, please ignore this email.
          Your account remains secure and no action is needed.
        </div>

        <p class="sign-off">
          Thanks,<br>
          <strong>E-Agraryo Merkado Team</strong>
        </p>

      </div>

      <!-- Footer -->
      <div class="email-footer">
        <p class="footer-app-name">DARRO 5</p>
        <p class="footer-text">
          This is an automated message — please do not reply to this email.<br>
          &copy; {{ date('Y') }} E-Agraryo Merkado. All rights reserved.
        </p>
      </div>

    </div>
  </div>

</body>
</html>