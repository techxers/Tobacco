<?php

namespace App\Http\Controllers;

use App\Imports\FarmerProfileImport;
use App\Imports\GradeImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
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
    public function importGrades() 
    {
        $import =  Excel::import(new GradeImport,request()->file('file'));
    
        return back()->withStatus('Import completed succesfully');
    }
    public function generateBuyingInvoice() 
    {
        $data = request()->validate([
            'bale_name' => [],
            'unique_no' => [],
            'weight' => [],
            'grade_id' => [],
            'transport_id' => [],
            'farmer_profile_id' => [],
            'created_at' => [],
            'updated_at' => []


        ]);
        // $data = ['title' => 'Welcome to ItSolutionStuff.com'];

        $pdf =  PDF::loadView('portal.pdf.invoice',$data);
        return $pdf->download('invoice.pdf');

        // $pdf->download('invoice.pdf');
        // return back()->withStatus('Import completed succesfully');
    }

    
}

