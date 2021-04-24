<?php


namespace App\Concern;


use Carbon\Carbon;

trait InDay
{
    public function scopeInDay($query){
        return $query->whereBetween('created_at', array(Carbon::now()->subDays(1)->toDateTimeString(), Carbon::now()->toDateTimeString()));
    }
}