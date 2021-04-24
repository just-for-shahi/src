<?php

namespace App\Mail;

use App\Helpers\BladeHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderSignalEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $innerText;
    private $template;
    private $order;

    public static function create($subject, $order, $template)
    {
        return new static($subject, $order, $template);
    }

    public function __construct($subject, $order, string $template)
    {
        $this->subject($subject);
        $this->order = $order;
        $this->template = $template;
    }

    public function build()
    {
        $address = config('mail.signal_email_from.address');
        $name = config('mail.signal_email_from.name');
        $view = 'emails.order_new';

        if($this->template && is_array($this->order))
            $this->innerText = BladeHelper::bladeCompile($this->template, $this->order);
        else
            $this->innerText = 'empty';

        return $this->markdown($view)
            ->from($address, $name)
            ->replyTo($address, $name);
    }

}
