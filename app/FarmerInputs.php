<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmerInputs extends Model
{
    protected $guarded = [];

    public function farmer()
    {
        return $this->belongsTo(FarmerProfile::class);
    }
}