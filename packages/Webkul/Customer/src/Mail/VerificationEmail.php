<?php

namespace Swim\Customer\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Verification Mail class
 *
 * @author    Rahul Shukla <rahulshukla.symfony517@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationData;

    public function __construct($verificationData) {
        $this->verificationData = $verificationData;
    }

    /**
     * Build the message.
     *
     * @return \Illuminate\View\View
     */
    public function build()
    {
        return $this->to($this->verificationData['email'])
            ->subject(trans('shop::app.mail.customer.verification.subject'))
            ->view('shop::emails.customer.verification-email')->with('data', ['email' => $this->verificationData['email'], 'token' => $this->verificationData['token']]);
    }
}