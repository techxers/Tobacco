<?php

namespace App\Http\Controllers;
use App\Table;
use Illuminate\Support\Facades\Request;




use Illuminate\Support\Facades\Config;

class PortalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(){
        $user=auth()->user();
        $farmer=$user->farmer_profile;
        return view('portal.dashboard',compact('user','farmer'));
    }
     public function menuList(){
        $user=auth()->user();
        $farmer=$user->farmer_profile;
        return view('portal.menu_list',compact('user','farmer'));
    }
    public function qrCodeView(){
        $user=auth()->user();
        $farmer=$user->farmer_profile;
        $url=route('qr.response',$farmer);
        $code=\QrCode::size(300)/*->format('png')
            ->merge(asset('images/aset.png'), .3,true)*/
            ->color(106, 27, 154)
            ->generate($url);

        return view('portal.qr_code_view',compact('user','farmer','code'));

    }
    public function gallery(){
        $user=auth()->user();
        $farmer=$user->farmer_profile;

        $breadcrumbs = [
            ['link'=>route('landing'),'name'=>config('app.name', 'Sahani')],['link'=>route('dashboard'),'name'=>"Portal"], ['name'=>"Gallery"]
        ];

        return view('portal.gallery',compact('user','farmer','breadcrumbs'));

    }
    public function ingredientList(){
        $user=auth()->user();
        $farmer=$user->farmer_profile;
        $ingredients=$user->farmer_profile->ingredients;
        return view('portal.ingredient_list',compact('user','ingredients','farmer'));
    }

    public function viewOrders(){
        $user=auth()->user();
        $farmer=$user->farmer_profile;
      
        return view('portal.orders_list',compact('user','farmer'));
    }

    public function viewCustomerOrders(){
        $user=auth()->user();
        $orders=$user->orders;
        return view('portal.customer_orders_list',compact('user','orders'));
    }

    public function profile(){
        $user=auth()->user();
        $farmer=$user->farmer_profile;
      
        return view('portal.profile',compact('user','farmer'));

    }

    public function viewTables(){
        $user=auth()->user();
        $farmer=$user->farmer_profile;
       
        $tables = Table::where('farmer_profile_id',$farmer->id)->get();
      //  dd($tables->count());
        return view('portal.farmer_configs',compact('user','tables'));

    }
    public function kulaPoints(){
        $user=auth()->user();
        $farmer=$user->farmer_profile;
        return view('portal.profile',compact('user','farmer'));

    }
    public function addTable(Request $request){

        $data = request()->validate([
            'title' => ['required'],
          
        ]);
        $user=auth()->user();
        $farmer=$user->farmer_profile->id;
        $table = Table::create([
            'title' => $data['title'],
            'status' => 0,

             'farmer_profile_id' => $farmer
        ]);
        $tables = Table::where('farmer_profile_id',$farmer)->get();
     
        return view('portal.farmer_configs',compact('user','tables'));
    

    }

    public function deleteTable(Request $request)
    {
     
          
            // $table = Table::find($request->id);
         
            // $table->update([
            //     'status' => $request->status,
                
            // ]);

            $table=Table::where('id',$$request->id)->delete();
            $user = auth()->user();
            $farmer=$user->farmer_profile;
            $tables = Table::where('farmer_profile_id',$farmer)->get();

            if($table){
                return view('portal.farmer_configs',compact('user','tables'));
            }
            return 'an error occured';
     
    }

}
