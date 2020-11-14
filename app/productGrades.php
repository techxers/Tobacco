<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productGrades extends Model
{
    protected $fillable = [
        'product_id', 'grade_id', 'yield_percentage', 'ration'
     ];
     public function product(){
        return $this->belongsTo(Product::class);
    }
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
