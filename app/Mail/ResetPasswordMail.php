<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;

    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        $url = url('/reset-password/' . $this->token . '?email=' . urlencode($this->user->email));
        $expires = config('auth.passwords.users.expire', 60);

        return $this->subject('Reset Password — e-Agraryo Merkado')
                    ->view('emails.reset_password')
                    ->with([
                        'user' => $this->user,
                        'url' => $url,
                        'expires' => $expires,
                    ]);
    }
}
