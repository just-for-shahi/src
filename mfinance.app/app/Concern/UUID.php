<?php

namespace App\Concern;

use Illuminate\Support\Str;

trait UUID
{

    public function authorizeAfterResolvingRouteBindingByUUID()
    {
        return false;
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = (string)Str::uuid();
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

    public function scopeUuid($query, $uuid)
    {
        return $query->where("uuid", $uuid);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $entity = self::where('uuid', $value)->firstOrFail();
        if ($this->authorizeAfterResolvingRouteBindingByUUID()) {
            \Gate::authorize('access-entity');
        }

        return $entity;
    }


}
