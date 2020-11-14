<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tobacco extends Model
{
    protected $guarded=[];
  
    public function farmer_profile(){
        return $this->belongsTo(FarmerProfile::class);
    }
    
}
