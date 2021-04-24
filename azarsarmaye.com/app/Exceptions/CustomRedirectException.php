<?php


namespace App\Exceptions;


use Throwable;

class CustomRedirectException extends \Exception
{
    public $response;

    public function report()
    {
        return true; // Determine if the exception needs custom reporting...
    }

    public function __construct($to = null)
    {
        if ($to) {
            $this->response = $to;
        } else {
            $this->response = back();
        }
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function render()
    {
        return $this->response;
    }
}
