<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TransformsRequest;



class NumberToEn extends TransformsRequest
{
    /**
     * The attributes that should be number2en.
     *
     * @var array
     */
    protected $inputs = [
        'mobile',
        'email',
        'username',
        'latitude',
        'longitude',
        'target',
        'current_balance',
        'collaborators',
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
            return $value ? number2en($value) : $value;
        }
        return $value;
    }
}
