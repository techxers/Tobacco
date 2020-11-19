<?php

namespace App\Http\Controllers;

use App\Imports\FarmerProfileImport;
use Maatwebsite\Excel\Facades\Excel;


class ImportExportController extends Controller
{
    /**
    * 
    */
    public function importExportView()
    {
       return view('importexport');
    }
    public function import() 
    {
        $import =  Excel::import(new FarmerProfileImport,request()->file('file'));
    
        return back()->withStatus('Import completed succesfully');
    }
}