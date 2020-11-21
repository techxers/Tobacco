<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $guarded = [];
    public function tobaccoProduct()
    {
        return $this->belongsTo(tobaccoProduct::class);
    }
}
