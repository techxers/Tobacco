<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function farmer_profile()
    {
        return $this->hasOne(FarmerProfile::class);
    }
   
   
}
