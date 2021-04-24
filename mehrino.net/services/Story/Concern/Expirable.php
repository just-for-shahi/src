<?php


namespace Services\Story\Concern;


use Carbon\Carbon;

trait Expirable
{
    public function scopeInDay($query){
        return $query->whereBetween('created_at', array(Carbon::now()->subDays(1)->toDateTimeString(), Carbon::now()->toDateTimeString()));
    }

}
