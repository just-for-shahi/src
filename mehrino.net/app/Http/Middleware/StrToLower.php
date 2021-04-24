<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TransformsRequest;



class StrToLower extends TransformsRequest
{
    /**
     * The attributes that should be number2en.
     *
     * @var array
     */
    protected $inputs = [
        'mobile',
        'email',
        'username'
    ];

    /**
     * Transform the given value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if (in_array($key, $this->inputs, true)) {
            return $value ? strtolower(''.$value) : $value;
        }
        return $value;
    }
}
