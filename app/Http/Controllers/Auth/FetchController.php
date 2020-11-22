<?php

namespace App\Http\Controllers;

use App\CropYear;
use App\FarmerProfile;
use App\tobaccoProduct;

use Illuminate\Support\Facades\DB;



use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;



use Illuminate\Http\Request;

class FetchController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // $restaurant = $user->farmer_profile;
        return view('portal.admin_dashboard', compact('user'));
    }

    public function fetchInvetory()
    {

        $data = request()->validate([
            'id' => []
        ]);
        $cropyear = CropYear::create([
            'year' => $data['year'],
            'desription' => $data['desription'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('message', 'success!');
    }
}