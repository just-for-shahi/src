<?php
// EmailHelper helper

use Illuminate\Support\Facades\Mail;

function sendVerify($email, $code)
{
    sendEmail('verify', $email, 'کد فعال سازی', [
        'code' => $code
    ]);
}

function sendEmail($view, $email, $subject, $data)
{
    Mail::send('mail::' . $view, $data, function ($message) use ($email, $subject) {
        $message->subject($subject);
        $message->to($email);
    });
}
