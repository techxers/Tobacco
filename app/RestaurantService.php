<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantService extends Model
{
    public function restaurant_profile()
    {
        return $this->belongsTo(RestaurantProfile::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
