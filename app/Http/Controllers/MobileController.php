<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use App\Order;
use App\Reservation;
use App\RestaurantProfile;
use App\User;
use App\News;
use App\Tips;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MobileController extends Controller
{
    // public function getRestaurants(RestaurantProfile $restaurants)
    // {
    //     return $this->jsonResponse(false, 'restaurants', 'restaurants', $restaurants);
    // }

  

    public function getMenuCategories(RestaurantProfile $restaurant)
    {
        $data = request()->validate([
            'category_id' => []
        ]);
        $menus = $restaurant->menus->where('category_id', $data['category_id']);
        return $this->jsonResponse(false, 'menus', 'menus', $menus);

    }

    /*
     *
     */
    public function jsonResponse($error, $message, $type, $result)
    {
        echo json_encode(array("error" => $error, "message" => $message, $type => $result));
    }


    public function loginInUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = DB::table('users')->where('email', $request->input('email'))->first();

        if (auth()->guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = auth()->guard('web')->user();

            return $this->jsonResponse(false, 'Successfully logged in', 'user', $user);
        }
        return $this->jsonResponse(true, 'Either the username or password is incorrect', 'user', null);
    }

    public function registerUser()
    {
        $data = request()->validate([
            'name' => [],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' =>[],
            'phone' =>[],
            'password' => []
        ]);
      ///  var_dump($data);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id'=>$data['role_id'],
            'phone'=>$data['phone'],
            'password' => Hash::make($data['password']),
        ]);

      
        return $this->jsonResponse(false, 'User registered successfully', 'user',$user);

    }
    // public function getCategories()
    // {
    //     $data = request()->validate([
    //         'restaurant_id' => []
    //     ]);
    //     $categories = RestaurantProfile::find($data['restaurant_id'])->categories;
    //     return $this->jsonResponse(false, 'restaurants', 'categories', $categories);
    // }
    public function getCategories()
    {
        $catagories = Category::all();
        return $this->jsonResponse(false, 'Categories', 'catagories', $catagories);
    }

    public function getAllRestaurants()
    {
        $restaurants = RestaurantProfile::all();
        return $this->jsonResponse(false, 'all restaurants', 'restaurants', $restaurants);
    }

    public function getMenus()
    {
        $menus = Menu::all();
        return $this->jsonResponse(false, 'menus', 'menus', $menus);
    }



    
    public function getTips()
    {
    //     $tips = Tips::all();
    //     return $this->jsonResponse(false, 'news or tips', 'tips', $tips);
    }

    public function getReservations()
    {
        $data = request()->validate([
            'user_id' => ['required']
        ]);
       // var_dump($data);
       // $reservations = Reservation::all();
        $reservations = DB::table('reservations')->where('user_id', $data['user_id'])->first();
        return $this->jsonResponse(false, 'user reservation', 'reservations', $reservations);
    }

    public function newReservation()
    {
        
        $data = request()->validate([
            'user_id' => ['required'],
            "restaurant_id" => ['required'],
            'table_no' => [],
            'paybill' => [],
            'name' => [],
            'number_of_people' => [],
            'phone' => [],
            'email' => [],
            'order_list' => [],
            'address' => [],
            'status' => [],
            'comment' => [],
        ]);
      //  var_dump($data);

            $data['rest_id'] = $data['restaurant_id'];
            unset($data['restaurant_id']);
            $reservation = Reservation::create($data);
            return $this->jsonResponse(false, 'reservation created successfully', 'reservation', $reservation);
     }
     
     public function getMenu()
     {
           $data = request()->validate([
            
            "restaurant_id" => ['required']
        ]);
    
         $menus = DB::table('menus')->where('restaurant_profile_id',$data['restaurant_id'])->get();
         return $this->jsonResponse(false, 'Single Restaurants Menu', 'menus', $menus);
     }
     public function getRestaurants()
     {
           $data = request()->validate([
            
            "restaurant_id" => ['required']
        ]);
       // var_dump($data);
         $restaurants = DB::table('restaurant_profiles')->where('id',$data['restaurant_id'])->first();;
         return $this->jsonResponse(false, 'Single Restaurants', 'restaurants', $restaurants);
     }
    public function getOrders()
    {
      
        $data = request()->validate([
            'user_id' => ['required']
        ]);
        $orders = DB::table('orders')->where('user_id', $data['user_id'])->get();

        //$orders = Order::where(['user_id', '=', $data['user_id']], ['rest_id', '=', $data['restaurant_id']])->get();
        return $this->jsonResponse(false, 'user orders', 'orders', $orders);
    }

    public function createorder()
    {
        $data = request()->validate([
            'user_id' => ['required'],
            "restaurant_id" => ['required'],
            'user_name' => [],
            'user_email' => [],
            'user_phone' => [],
            'order_list' => [],
            'order_status' => [],
            'payment_status' => [],
            'delivery_status' => [],
            'delivery_by' => [],
            'delivery_at' => [],
            'table_name' => [],
            'comment' => [],
        ]);
        $data['rest_id'] = $data['restaurant_id'];
        unset($data['restaurant_id']);
        $order = Order::create($data);
        return $this->jsonResponse(false, 'order created successfully', 'order', $order);
    }


}
