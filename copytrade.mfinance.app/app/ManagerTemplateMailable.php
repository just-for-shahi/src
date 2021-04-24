<?php

namespace App;

use App\Models\ManagerMailTemplate;
use Spatie\MailTemplates\TemplateMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class ManagerTemplateMailable extends TemplateMailable
{
    use Queueable, SerializesModels;

    protected static $templateModelClass = ManagerMailTemplate::class;

    private $managerId;
    private $tag;
    private $layout;

    public function __construct($managerId, $tag = null) {
        $this->managerId = $managerId;
        $this->tag = $tag;
    }

    public function getManagerId(): int
    {
        return $this->managerId;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function getHtmlLayout(): string
    {
        if(!empty($this->layout))
            return $this->layout;

        try {
            return view('emails.layout', [])->render();
        } catch (\Throwable $e) {
        }

        return "{{{body}}}";
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

}
