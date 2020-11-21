<?php

namespace App\Imports;

use App\Grade;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;
use Carbon\Carbon;

class GradeImport implements ToModel, WithHeadingRow,SkipsOnError,SkipsOnFailure
{
    use Importable,SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Grade([
            'name' => $row['name'],
            'number' => $row['number'],
            'tobacco_id' => $row['tobacco_id'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
    
    // public function onError(Throwable $error){

    // }
    public function onFailure(Failure  ...$failure){

    }
}