<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmInput extends Model
{
    public function weight_units(){
        return $this->belongsTo(WeightUnit::class);
    }

    protected $guarded = [];
}
