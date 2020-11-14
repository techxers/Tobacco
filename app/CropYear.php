<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CropYear extends Model
{
    protected $guarded=[];
  
    public function farmer_profile(){
        return $this->belongsTo(FarmerProfile::class);
    }
   
}
