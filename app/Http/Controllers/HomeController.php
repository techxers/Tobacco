<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\RestaurantProfile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function listRestaurants()
    {
        $restaurants = RestaurantProfile::orderBy('created_at', 'DESC');
        $restaurantsPaginated = $restaurants->paginate(6);
        $restaurants = $restaurants->get();
        $filterType = $restaurants->unique('type');
        return view('pages.restaurants', compact('restaurantsPaginated', 'restaurants', 'filterType'));
    }

    public function viewRestaurantMenu(RestaurantProfile $restaurant)
    {
      
        $user = auth()->user();
        return view('pages.view_rst_menu', compact('restaurant', 'user'));
    }

    public function restaurantProfile(RestaurantProfile $restaurant)
    {

        $user = auth()->user();
        return view('pages.view_rst_profile', compact('restaurant', 'user'));
    }


    public function restaurantCategories()
    {

        $restaurant_id = request()->id;
        $categories = Category::where("rest_id", $restaurant_id)->get();
        return view('pages.categories', compact('categories'));
    }



    public function NewRestaurant()
    {
        return view('pages.submit_restaurant');
    }
    public function menuAll()
    {
        return view('pages.menu_all');
    }
    public function delete(Request $request)
    {
        $data = request()->validate([
            "menu_id" => ['required']
        ]);
        $menu = Menu::find($data['menu_id']);


        $menu->delete();
         
        return view('pages.menu_all');
    }


    public function searchItems(Request $item)
    {
        $data = request()->validate([
            'search_item' => []
        ]);
        $restaurants = RestaurantProfile::orderBy('created_at', 'DESC')->get();
        $filterType = $restaurants->unique('type');

        $menus = Menu::orderBy('created_at', 'DESC')->filterSearch()->paginate(6);

        return view('pages.search_view', compact('menus', 'restaurants', 'filterType'));
    }


    public function submitRestaurant()
    {
        $data = request()->validate([
            'name' => [],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' => [],
            'rst_name' => [],
            'website' => [],
            'rst_email' => [],
            'rst_phone' => [],
            'phone' => [],
            'password' => ['required', 'string', 'min:7', 'confirmed'],


        ]);


        // if (!$data['password'] == $data['password']){

        //     return redirect()->back()->with('error', 'Password do not match');

        // }
        $restaurantProfile = RestaurantProfile::create([
            'title' => $data['rst_name'],
            'email' => $data['email'],
            'phone' => $data['rst_phone'],
            'website' => $data['website'],

        ]);
        if ($restaurantProfile) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => 2,
                'phone' => $data['phone'],
                'password' => Hash::make($data['password']),
                'restaurant_profile_id' => $restaurantProfile->id
            ]);
            event(new Registered($user));
        }

        return view('auth.verify', compact('user'));
    }

    public function submitDriver()
    {
        $user = auth()->user();
        return view('pages.submit_driver', compact('user'));
    }
}
