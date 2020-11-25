<?php

namespace App\Http\Controllers;

use App\CropYear;
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
use App\Transport;
use App\City;

use Illuminate\Support\Facades\DB;



use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;



use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // $restaurant = $user->farmer_profile;
        return view('portal.admin_dashboard', compact('user'));
    }
    public function manageUsers()
    {
        $user = auth()->user();
        $farmers = FarmerProfile::where('status', 1)->get();


        return view('portal.admin_manage_users', compact('user', 'farmers'));
    }

    public function addTobacco()
    {
        $data = request()->validate([
            'name' => [],
            'number' => []

        ]);
        $user = auth()->user();
        $tobaccos = Tobacco::create([
            'name' => $data['name'],
            'number' =>  $data['number'],
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
            'number' => [],
            'tobacco_id' => []

        ]);
        $user = auth()->user();
        $tobaccos = Grade::create([
            'name' => $data['name'],
            'number' => $data['number'],
            'tobacco_id' =>  $data['tobacco_id'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user = auth()->user();

        return redirect()->back()->with('message', 'success!');
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
    public function editGrade($grade_id)
    {
        $user = auth()->user();

        $grade = Grade::find($grade_id);
        return view('portal.edit_grade', compact('grade', 'user'));
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
            'id' => [],
            'tobbaco_id' => []

        ]);
        //get the lorry weight
        $tobacco = tobaccoProduct::where('id', $data['tobbaco_id'])->first();
        //check status Zero Means Lorry Not Offloaded

        if ($tobacco->status == 0) {
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
                    'status' => 1

                ]);
            }
        }

        return 1;
    }

    public function addProduct()
    {
        $data = request()->validate([
            'name' => [],
            'number' => [],
            'description' => []

        ]);
        $user = auth()->user();
        $tobaccos = Product::create([
            'name' => $data['name'],
            'description' =>  $data['description'],
            'number' =>  $data['number'],
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
        return view('portal.admin_manage_tobacco', compact('tobaccos', 'user'));
    }

    public function viewTransport()
    {
        $user = auth()->user();
        $transports = Transport::all();

        return view('portal.admin_manage_transport', compact('user', 'transports'));
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
    public function addTransport()
    {

        $data = request()->validate([
            'plate' => [],
            'type' => [],
            'driver' => []

        ]);
        $tobaccoProduct = Transport::create([
            'plate' => $data['plate'],
            'type' => $data['type'],
            'driver' => $data['driver'],
            'description' => 'Vehicle Reg No' . $data['plate']  . 'model' . $data['type'] . 'assigned to ' . 'driver' . $data['driver'] . 'on' . Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user = auth()->user();
        $transports = Transport::all();

        return view('portal.admin_manage_transport', compact('user', 'transports'));
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

        // return redirect()->back()->with('message', 'Bale added');
        return view('portal.buying', compact('user', 'tobaccoProduct'));
    }

    public function cropYeadAdd()
    {

        $data = request()->validate([
            'year' => [],
            'desription' => [],
            'start_date' => [],
            'end_date' => [],
            'status' => [],
        ]);

        $cropyear = CropYear::create([
            'year' => $data['year'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'desription' => '',
            'status' => $data['status'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back()->with('message', 'success!');
    }
    public function addCustomer()
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
            // 'image' => $url ?? '',
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
            'postal_address' => [],
            // 'country_id' => [],
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
            'postal_address' => $data['postal_address'],
            'country_id' => 1,
            'city_id' => $data['city_id'],
            'cropyear_id' => $data['cropyear_id'],
            // 'region_id' => $data['region_id'],
            'phone' => $data['phone'],
            'status' => 1,
            'number' => rand(1, 1000000),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user = auth()->user();
        $message = 'Farmer Created Succesfully , No Assigned' . '  ' . $farmer->number;
        return view('portal.new_farmer', compact('user', 'message'));
        // return redirect()->back()->with('message', 'success!');
    }
    public function manageAdd()
    {
        $user = auth()->user();
        return view('portal.new_farmer', compact('user'));
    }


    public function cropYear()
    {
        $user = auth()->user();
        $Crops = CropYear::all();
        return view('portal.admin_manage_crop_year', compact('user', 'Crops'));
    }
    public function editFarmer($user_id)
    {
        $user = auth()->user();
        $farmer = FarmerProfile::find($user_id);
        return view('portal.update_farmer', compact('user', 'farmer'));
    }
    public function viewRegion()
    {
        $user = auth()->user();
        $regions = Region::all();

        return view('portal.admin_manage_region', compact('user', 'regions'));
    }
    public function viewCounty()
    {
        $user = auth()->user();
        $counties  = City::all();

        return view('portal.admin_manage_county', compact('user', 'counties'));
    }
    public function addfarmerCropYear()
    {
        $data = request()->validate([
            'farmer_id' => [],
            'cropyear_id' => [],

        ]);
        //Not deleting ,change status
        $farmer = FarmerProfile::find($data['farmer_id']);
        //  dd($request->status);
        $farmer->update([
            'cropyear_id' => $data['cropyear_id']

        ]);
        return redirect()->back()->with('success', 'success!');
    }


    public function farmerCropYear()
    {

        $data = request()->validate([
            'term' => [],

        ]);

        if (isset($data['term'])) {
            $user = auth()->user();
         
         
            $farmer  =  DB::table('farmer_profiles')
                ->where([
                    ['first_name', 'like', '%' . $data['term'] . '%'],
                    ['status', 1]

                ])->orWhere('last_name', 'like', '%' . $data['term'] . '%')
                ->orWhere('middle_name', 'like', '%' . $data['term'] . '%')
                ->orWhere('id_number', 'like', '%' . $data['term'] . '%')
                ->orWhere('number', 'like', '%' . $data['term'] . '%')
                ->orWhere('phone', 'like', '%' . $data['term'] . '%')
                ->orWhere('last_name', 'like', '%' . $data['term'] . '%')
                ->first();
               
        } else {
            $user = auth()->user();
          
         
        }
        $farmer ="";
        $farmers  = FarmerProfile::with('cropyear')->where('status',1)->get();
        return view('portal.add_farmer_cropyear', compact('user', 'farmers', 'farmer'));
    }

    public function activate($crop_id)
    {
        //Not deleting ,change status
        $res = CropYear::find($crop_id);
        //  dd($request->status);
        $res->update([
            'status' => 1

        ]);
        return redirect()->back()->with('message', 'success!');
    }
    public function UpdateFarmer()
    {
        $data = request()->validate([
            'first_name' => [],
            'middle_name' => [],
            'cropyear_id' => [],
            'phone' => [],
            'postal_address' => [],
            'id_number' => [],
            'email' => [],
            'last_name' => [],
            'id' => []

        ]);

        $farmer = FarmerProfile::find($data['id']);
        $farmer->update([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'cropyear_id' => $data['cropyear_id'],
            'phone' => $data['phone'],
            'postal_address' => $data['postal_address'],
            'id_number' => $data['id_number'],
            'email' => $data['id'],
            'last_name' => $data['last_name']
        ]);
        return redirect()->back()->with('message', 'success!');
    }

    public function deactivate($crop_id)
    {
        //Not deleting ,change status
        $res = CropYear::find($crop_id);
        //  dd($request->status);
        $res->update([
            'status' => 2

        ]);
        return redirect()->back()->with('message', 'success!');
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
    public function deleteTobacoType($tobacco_id)
    {

        $res = tobacco::find($tobacco_id)->delete();
        //  dd($request->status);
        return redirect()->back()->with('message', 'success!');
    }
    public function deleteTransport($transport_id)
    {

        $res = Transport::find($transport_id)->delete();
        //  dd($request->status);
        return redirect()->back()->with('message', 'success!');
    }



    public function deleteProduct($product_id)
    {
        //remove product
        Product::find($product_id)->delete();
        //  dd($request->status);
        return redirect()->back()->with('message', 'success!');
    }
    public function deleteGrade($grade_id)
    {
        //Not deleting ,change status
        $res = Grade::find($grade_id)->delete();
        //  dd($request->status);
        return redirect()->back()->with('message', 'success!');
    }

    public function addCounty()
    {
        $data = request()->validate([
            'name' => []

        ]);
        $city = City::create([
            'country_id' => 1,
            'name' => $data['name'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
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

    public function updateGrade(Request $request)
    {
        $data = request()->validate([
            'name' => [],
            'number' => [],
            'tobacco_id' => [],
            'id' => [],


        ]);
        $res = Grade::find($data['id']);
        $res->update([
            'name' => $data['name'],
            'number' => $data['number'],
            'tobacco_id' => $data['tobacco_id']

        ]);
        $user = auth()->user();
        $grades = Grade::all();
        return view('portal.admin_manage_grades', compact('grades', 'user'));
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

        $users = User::all()->where('role_id', 2);

        return view('portal.admin_manage_users', compact('user', 'users'));
    }


    //###############################View Edit ##################################//


    public function viewEditProduct($id)
    {
        $user = auth()->user();
        $product = Product::find($id);
        return view('portal.edit_product', compact('user', 'product'));
    }

    //###############################End View Edit ##################################//

    //############################### Update Section ##################################//


    public function updateProduct()
    {
        $data = request()->validate([
            'name' => [],
            'number' => [],
            'description' => [],
            'id' => [],


        ]);
        $res = Product::find($data['id']);
        $res->update([
            'name' => $data['name'],
            'number' => $data['number'],
            'description' => $data['description']

        ]);
        $user = auth()->user();
        $products = Product::all();
        return view('portal.admin_manage_product', compact('products', 'user'));
    }

    //###############################End pdate Sectio ##################################//





    public function searchFarmer()
    {
        $data = request()->validate([
            'term' => [],

        ]);

        $user = auth()->user();
        $farmers  =  DB::table('farmer_profiles')
            ->where([
                ['first_name', 'like', '%' . $data['term'] . '%'],
                ['status', 1]

            ])->orWhere('last_name', 'like', '%' . $data['term'] . '%')
            ->orWhere('middle_name', 'like', '%' . $data['term'] . '%')
            ->orWhere('id_number', 'like', '%' . $data['term'] . '%')
            ->orWhere('number', 'like', '%' . $data['term'] . '%')
            ->orWhere('phone', 'like', '%' . $data['term'] . '%')
            ->orWhere('last_name', 'like', '%' . $data['term'] . '%')
            ->get();

        return view('portal.admin_manage_users', compact('user', 'farmers'));
    }
    public function searchGrades()
    {
        $data = request()->validate([
            'term' => [],

        ]);

        $user = auth()->user();
        $grades  =  DB::table('grades')
            ->where([
                ['name', 'like', '%' . $data['term'] . '%'],

            ])->get();

        return view('portal.admin_manage_grades', compact('user', 'grades'));
    }

    public function searchProduct()
    {
        $data = request()->validate([
            'term' => [],

        ]);

        $user = auth()->user();
        $products  =  DB::table('products')
            ->where([
                ['name', 'like', '%' . $data['term'] . '%'],

            ])->orWhere('number', 'like', '%' . $data['term'] . '%')
            ->get();

        return view('portal.admin_manage_product', compact('user', 'products'));
    }
}
