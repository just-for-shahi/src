<?php


namespace App\Concern;


trait Distance
{
    public function scopeDistance($query, $lat, $lng , $distance = 20)
    {
        if (x_lat() && x_long() && !empty(x_lat()) && !empty(x_long())) {
            $row = "( " .
                "6371 * " .
                "acos( " .
                "cos( radians($lat) ) * " .
                "cos( radians( latitude ) ) * " .
                "cos( " .
                "radians( longitude ) - radians($lng)" .
                ") + " .
                "sin( radians($lat) ) * " .
                "sin( radians( latitude ) ) " .
                ")" .
                ")";
            return $query
                ->addSelect(\DB::raw(" *,$row as distance"))
                ->where(\DB::raw($row), '<', 200)
                ->orderBy('distance', 'ASC');
        }
        return $query;
    }
}
