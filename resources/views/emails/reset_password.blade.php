<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Reset Your Password – DARRO 5</title>
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

    /* Lock icon badge */
    .icon-badge {
      width: 64px;
      height: 64px;
      background: #f4fce8;
      border: 1.5px solid #bbf7a0;
      border-radius: 50%;
      margin: 0 auto 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      text-align: center;
      line-height: 64px;
    }

    /* CTA block */
    .cta-block {
      background: #f4fce8;
      border: 1.5px solid #bbf7a0;
      border-radius: 14px;
      padding: 28px 24px;
      text-align: center;
      margin-bottom: 28px;
    }

    .cta-label {
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      color: #2e7d0e;
      margin-bottom: 8px;
    }

    .cta-desc {
      font-size: 14px;
      color: #6b7280;
      margin-bottom: 20px;
      line-height: 1.5;
    }

    .btn-cta {
      display: inline-block;
      background: linear-gradient(135deg, #f5c800 0%, #d4a800 100%);
      color: #1a2e0a !important;
      text-decoration: none;
      font-size: 15px;
      font-weight: 700;
      padding: 14px 36px;
      border-radius: 10px;
      letter-spacing: 0.2px;
      box-shadow: 0 4px 16px rgba(245, 200, 0, 0.40);
    }

    .expiry-note {
      margin-top: 14px;
      font-size: 13px;
      color: #9ca3af;
    }

    .expiry-note span {
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
      border-radius: 8px;
      padding: 14px 16px;
      font-size: 13.5px;
      color: #6b4c00;
      line-height: 1.5;
      margin-bottom: 24px;
    }

    .warning-box strong { color: #4a3300; }

    /* Fallback URL block */
    .fallback-block {
      background: #f9fafb;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      padding: 14px 16px;
      margin-bottom: 24px;
    }

    .fallback-label {
      font-size: 12px;
      font-weight: 600;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 6px;
    }

    .fallback-url {
      font-size: 12px;
      color: #2e7d0e;
      word-break: break-all;
      line-height: 1.5;
      font-family: 'Courier New', Courier, monospace;
    }

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
      .cta-block { padding: 22px 16px; }
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

        <div class="icon-badge">🔑</div>

        <p class="greeting" style="text-align:center;">Password Reset Request</p>

        <p class="body-text" style="text-align:center;">
          We received a request to reset the password for your account.
          Click the button below to choose a new password.
        </p>

        <!-- CTA block -->
        <div class="cta-block">
          <p class="cta-label">Reset your password</p>
          <p class="cta-desc">This link is valid for <span style="color:#e65c00;font-weight:600;">{{ $expires }} minutes</span>. After that, you'll need to request a new one.</p>
          <a href="{{ $url }}" class="btn-cta">Reset Password</a>
          <p class="expiry-note">Link expires in <span>{{ $expires }} minutes</span></p>
        </div>

        <hr class="divider">

        <!-- Warning -->
        <div class="warning-box">
          <strong>Didn't request this?</strong> If you did not request a password reset, no action is needed — your password will remain unchanged and this link will expire automatically.
        </div>

        <!-- Fallback URL -->
        <div class="fallback-block">
          <p class="fallback-label">Having trouble with the button?</p>
          <p class="fallback-url">{{ $url }}</p>
        </div>

        <p class="sign-off">
          Regards,<br>
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