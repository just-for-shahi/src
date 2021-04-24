<?php

namespace App\Concern;

use Illuminate\Support\Str;

trait UUID
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (! $model->uuid) {
                $model->uuid = (string) Str::uuid();
            }
        });

    }

    public function getIncrementing()
    {
        return true;
    }

    public function getKeyType()
    {
        return 'string';
    }

    protected static function bootUsesUuid()
    {
        static::creating(function ($model) {
            $model->uuid = (string)Str::uuid();
        });
    }

    public function scopeFindUUID($query, $uuid)
    {
        return $query->where("uuid", $uuid)->first();
    }

}
