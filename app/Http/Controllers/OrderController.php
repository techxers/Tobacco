<?php

namespace App\Http\Controllers;

use App\Menu;
use App\RestaurantProfile;
use App\RestaurantService;
use Illuminate\Http\Request;
use App\TempOrder;
use App\Order;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function cartAdd(Menu $menu)
    {
      
        $data = request()->validate([
            'menu_ingredients' => 'array',
            'menu_ingredients.*' => 'string',
            'menu_size_id' => [],
         

            
        ]);
       

        $user = auth()->user();

        $temp_order = $menu->temp_orders()->create(
            [
                'user_id' => $user->id,
                'restaurant_profile_id' => $menu->restaurant_profile->id,
                'menu_size_id' => $data['menu_size_id']
               
            ]
        );
        if (isset($data['menu_ingredients']))
            foreach ($data['menu_ingredients'] as $key => $val) {
                $temp_order->temp_ingredients()->create([
                    'menu_ingredient_id' => $val
                ]);
            }
          
        return json_encode(array('message' => 'Item ' . $temp_order->menu->title . ' added to cart, successfully.'));
    }

    public function cartComplete(RestaurantProfile $restaurant)
    {

      
        $data = request()->validate([
            'restaurant_service_id' => [],
        ]);
     //   $user = auth()->user();
      //  dd($data);
        session(['restaurant_service_id' =>  $data['restaurant_service_id']]);

        return redirect()->route('order.step2', $restaurant);
    }

    public function orderStep2(RestaurantProfile $restaurant)
    {

        
        
         
        $restaurant_service = RestaurantService::find(session('restaurant_service_id'));


        $user = auth()->user();

        return view('pages.cart1', compact('user', 'restaurant', 'restaurant_service'));
    }
    public function updateOrderStatus(Request $request)
    {
     //   dd($request);
        
        // $data = request()->validate([
         
        //     "user_id" => [],
        //     "status" => [],
        //     "order_id" => []
        // ]);
          
            $order = Order::find($request->order_id);
          //  dd($request->status);
            $order->update([
                'status' => $request->status,
                
            ]);
            $user = auth()->user();
            $restaurant=$user->restaurant_profile;
        
            if($order){
                return view('portal.orders_list',compact('user','restaurant'));
            }
            return 'an error occured';
     
    }



    public function orderStep3(RestaurantProfile $restaurant)
    {
        $data = request()->validate([
            'table_id' => [],
            'notes' => []
        ]);

       
        //var_dump($data);
        $user = auth()->user();

        $restaurant_service = RestaurantService::find(session('restaurant_service_id'));

        $temp_orders = TempOrder::where([['user_id', '=', $user->id], ['restaurant_profile_id', '=', $restaurant->id]])->get()->unique('menu_id');
        foreach ($temp_orders as $temp_order)
            $order = $restaurant->orders()->create([
                'restaurant_service_id' => $restaurant_service->id,
                'user_id' => $user->id,
                'menu_id' => $temp_order->menu_id,
                'quantity' => \App\TempOrder::where('menu_id', $temp_order->menu_id)->get()->count(),
                'table_id' => $data['table_id'] ?? null,
                'notes' => $data['notes'] ?? null,
                'status' => 1

            ]);

        return view('pages.cart2', compact('user', 'restaurant'));
    }
}
