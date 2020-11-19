<?php

namespace App\Imports;

use App\FarmerProfile;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;


use Carbon\Carbon;
use Throwable;

class FarmerProfileImport implements ToModel, WithHeadingRow,SkipsOnError,WithValidation,SkipsOnFailure
{
    use Importable,SkipsErrors;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new FarmerProfile([
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'id_number' => $row['id_number'],
            'postal_address' => $row['postal_address'],
            'country_id' => $row['country_id'],
            'city_id' => $row['city_id'],
            'cropyear_id' => $row['cropyear_id'],
            'region_id' => $row['region_id'],
            'phone' => $row['phone'],
            'status' => 1,
            'number' => rand(1, 1000000),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
    public function rules(): array
    {
        return[
            '*.id_number' => ['numeric', 'unique:farmers_profiles,id_number']
        ];
    }
    // public function onError(Throwable $error){

    // }
    public function onFailure(Failure  ...$failure){

    }
}
