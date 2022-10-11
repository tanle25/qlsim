<?php

namespace App\Mail;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Itrojan

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $user;
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // $otp = OTP
        $token = new Otp;
        $otp = $token->generate($this->user->email, 4, 5);
        return $this->subject('Email được gửi từ '. env('APP_NAME'))->view('login.verify-email',['otp'=>$otp]);
    }
}
