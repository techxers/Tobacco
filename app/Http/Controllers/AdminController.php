<?php

namespace App\Http\Controllers;

use App\FarmerProfile;
use App\User;
use App\tobacco;
use App\Grade;
use App\Product;
use App\tobaccoProduct;
use App\MainStorage;
use App\Order;
use App\WeightUnit;
use App\Region;
use App\productGrades;



use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;



use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $restaurant = $user->farmer_profile;
        return view('portal.admin_dashboard', compact('user', 'restaurant'));
    }
    public function manageUsers()
    {
        $user = auth()->user();
        $farmers = FarmerProfile::where('status',1)->get();


        return view('portal.admin_manage_users', compact('user', 'farmers'));
    }

    public function addTobacco()
    {
        $data = request()->validate([
            'name' => [],
            'description' => []

        ]);
        $user = auth()->user();
        $tobaccos = Tobacco::create([
            'name' => $data['name'],
            'description' =>  $data['description'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user = auth()->user();

        $tobaccos = Tobacco::all();
        return view('portal.admin_manage_tobacco', compact('tobaccos', 'user'));
    }
    public function addGrade()
    {
        $data = request()->validate([
            'name' => [],
            'description' => []

        ]);
        $user = auth()->user();
        $tobaccos = Grade::create([
            'name' => $data['name'],
            'description' =>  $data['description'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user = auth()->user();

        $grades = Tobacco::all();
        return view('portal.admin_manage_grades', compact('grades', 'user'));
    }

    public function manageGrades()
    {
        $user = auth()->user();
        $grades = Grade::all();

        return view('portal.admin_manage_grades', compact('grades', 'user'));
    }
    public function viewOrderList()
    {
        $user = auth()->user();
        $orders = Order::all();

        return view('portal.orders_list', compact('orders', 'user'));
    }
    
    public function createOrder()
    {
        $data = request()->validate([
            'order_number' => [],
            'farmer_id' => [],
            'amount' => [],
            'product_id' => [],
            'grade_id' => [],
            'params' => [],
            'packaging' => [],
            'grade_id' => [],


        ]);
        $order = Order::create([
            'order_number' => $data['order_number'],
            'grade_id' =>  $data['grade_id'],
            'user_id' =>  $data['farmer_id'],
            'amount' =>  $data['amount'],
            'product_id' =>  $data['product_id'],
            'params' =>  $data['params'],
            'packaging' =>  $data['packaging'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('message', 'success!');

    }

    public function manageProducts()
    {
        $user = auth()->user();
        $products = Product::all();

        return view('portal.admin_manage_product', compact('products', 'user'));
    }
    public function manageProductsGrades()
    {
        $user = auth()->user();
        $productgrades = productGrades::all();

        return view('portal.admin_manage_product_grades', compact('productgrades', 'user'));
    }

    public function addProductGrade()
    {
        $data = request()->validate([
            'product_id' => [],
            'grade_id' => [],
            'yield_percentage' => [],
            'ration' => []

        ]);
        $user = auth()->user();
        $productgrade = productGrades::create([
            'product_id' => $data['product_id'],
            'grade_id' =>  $data['grade_id'],
            'yield_percentage' =>  $data['yield_percentage'],
            'ration' =>  $data['ration'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user = auth()->user();
        $productgrades = productGrades::all();
        return view('portal.admin_manage_product_grades', compact('productgrades', 'user'));
    }

    public function createReceiving()
    {
        $data = request()->validate([
            'tobacco_product_id' => [],

        ]);

        //get the lorry weight
        $tobacco = tobaccoProduct::where('id', $data['tobacco_product_id'])->first();
        //  dd($tobacco);
        //check status

        if ($tobacco->lorry_status_id == 0) {
            // create main store record
            $mainStorage = MainStorage::create([
                'tobacco_product_id' => $tobacco->id,
                'amount' =>   $tobacco->weight,
                'plate' =>  '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            if ($mainStorage) {
                $tobacco->update([

                    'weight' => 0,
                    'lorry_status_id' => 1

                ]);
            }
            return redirect()->back()->with('message', 'IT WORKS!');
        } else {

            return redirect()->back()->with('message', 'success!');
        }

        //remove weight from lorry

    }

    public function addProduct()
    {
        $data = request()->validate([
            'name' => [],
            'description' => []

        ]);
        $user = auth()->user();
        $tobaccos = Product::create([
            'name' => $data['name'],
            'description' =>  $data['description'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user = auth()->user();

        $products = Product::all();
        return view('portal.admin_manage_product', compact('products', 'user'));
    }
    public function manageTobacco()
    {
        $user = auth()->user();
        $tobaccos = Tobacco::all();
        $user = auth()->user();


        return view('portal.admin_manage_tobacco', compact('tobaccos', 'user'));
    }

    public function updateProduct()
    {
        $user = auth()->user();
        return view('portal.buying', compact('user'));
    }
    public function showReceiving()
    {
        $user = auth()->user();
        return view('portal.receiving', compact('user'));
    }
    public function viewMeasure()
    {
        $user = auth()->user();
        $units = WeightUnit::all();

        return view('portal.view_measure', compact('user', 'units'));
    }
    public function measureAdd()
    {

        $data = request()->validate([
            'unit_name' => [],
            'measure' => []
        ]);
        $tobaccoProduct = WeightUnit::create([
            'unit_name' => $data['unit_name'],
            'measure' => $data['measure'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user = auth()->user();
        $units = WeightUnit::all();

        return view('portal.view_measure', compact('user', 'units'));
    }

    public function viewOrder()
    {
        $user = auth()->user();

        return view('portal.order', compact('user'));
    }
    public function viewCustomer()
    {
        $user = auth()->user();
        $users = FarmerProfile::where('role_id', 3)->get();
        return view('portal.admin_manage_customers', compact('user', 'users'));
    }
    public function showBuying()
    {
        $user = auth()->user();
        return view('portal.buying', compact('user'));
    }

    public function createBuying()
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

        $tobaccoProduct = tobaccoProduct::create([
            'bale_name' => $data['bale_name'],
            'unique_no' => $data['unique_no'],
            'weight' => $data['weight'],
            'grade_id' => $data['grade_id'],
            'transport_id' => $data['transport_id'],
            'farmer_profile_id' => $data['farmer_profile_id'],
            'lorry_status_id' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user = auth()->user();

        return redirect()->back()->with('message', 'Bale added');
        // return view('portal.admin_manage_users', compact('user', 'farmers'));
    }


    public function addCustomer()
    {
        $data = request()->validate([
            'full_name' => [],
            'email' => [],
            'id_number' => [],
            'address' => [],
            'country_id' => [],
            'city_id' => [],
            'region_id' => [],
            'phone' => []

        ]);

        if (request()->hasFile('logo')) {
            $file = request()->file('logo');
            $imagePath = request()->file('logo')->store('logos', 'images');
            $url = Storage::disk('images')->url($imagePath);
            $imageArray = ['logo' => $url];
        }
      


        $farmer = FarmerProfile::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'id_number' => $data['id_number'],
            'postal_address' => $data['address'],
            'country_id' => $data['country_id'],
            'city_id' => $data['city_id'],
            'role_id' => 3,
            'region_id' => $data['region_id'],
            'phone' => $data['phone'],
            'status' => 1,
            'image' => $url,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user = auth()->user();
        $users = FarmerProfile::where('role_id', 3)->get();
        return view('portal.admin_manage_customers', compact('user', 'users'));
    }
    public function addFarmer()
    {
        $data = request()->validate([
            'first_name' => [],
            'middle_name' => [],
            'last_name' => [],
            'email' => [],
            'id_number' => [],
            'address' => [],
            'country_id' => [],
            'city_id' => [],
            'region_id' => [],
            'cropyear_id' => [],
            'phone' => []



        ]);


        $farmer = FarmerProfile::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'id_number' => $data['id_number'],
            'postal_address' => $data['address'],
            'country_id' => $data['country_id'],
            'city_id' => $data['city_id'],
            'cropyear_id' => $data['cropyear_id'],
            'region_id' => $data['region_id'],
            'phone' => $data['phone'],
            'status' => 1,
            'number'=>rand(1,1000000),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user = auth()->user();
        $message = 'Farmer Created Succesfully , No Assigned' .'  ' .$farmer->number;
        return view('portal.new_farmer', compact('user', 'message'));
        // return redirect()->back()->with('message', 'success!');
    }
    public function manageAdd()
    {
        $user = auth()->user();
        return view('portal.new_farmer', compact('user'));
    }
    public function editFarmer($user_id)
    {
        $user = auth()->user();
        $farmer = FarmerProfile::find($user_id);
        return view('portal.new_farmer', compact('user','farmer'));
    }
    public function viewRegion()
    {
        $user = auth()->user();
        $regions = Region::all();

        return view('portal.admin_manage_region', compact('user','regions'));
    }
    
    public function deleteFarmer($farmer_id)
    {
       //Not deleting ,change status
       $res = FarmerProfile::find($farmer_id);
       //  dd($request->status);
       $res->update([
           'status' => 0

       ]);
       return redirect()->back()->with('message', 'success!');
    }
    public function addRegion()
    {
        $data = request()->validate([
            'city_id' => [],
            'name' => []

        ]);
        $farmer = Region::create([
            'city_id' => $data['city_id'],
            'name' => $data['name'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('message', 'success!');

    }
    public function UpdateStatus(Request $request)
    {
        $data = request()->validate([
            'farmer_profile_id' => [],
            'status' => []

        ]);
        // dd($data);

        $res = FarmerProfile::find($request->farmer_profile_id);
        //  dd($request->status);
        $res->update([
            'status' => $request->status,

        ]);
        $user = auth()->user();
        $restaurant = $user->farmer_profile;

        $users = User::all()->where('role_id', 2);;

        return view('portal.admin_manage_users', compact('user', 'users'));
    }
}
