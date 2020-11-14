<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $guarded=[];
  
    public function farmer_profile(){
        return $this->belongsTo(Product::class);
    }
    public function tobacco(){
        return $this->belongsTo(Tobacco::class);
    }
  
}
