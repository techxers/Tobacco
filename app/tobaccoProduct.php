<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tobaccoProduct extends Model
{
    protected $guarded = [];
    public function transport(){
        return $this->hasMany(Transport::class);
    }
}
