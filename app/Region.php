<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function farmer_profile()
    {
        return $this->hasOne(FarmerProfile::class);
    }
   
   
}
