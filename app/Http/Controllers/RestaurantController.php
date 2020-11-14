<?php

namespace App\Http\Controllers;

use App\RestaurantProfile;
use App\User;

use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    public function qrCodeResponse(RestaurantProfile $restaurant)
    {
        return redirect()->route('pages.restaurants.menu', $restaurant);
    }

    public function addToGallery(RestaurantProfile $restaurant)
    {
        $data = request()->validate([
            'summary' => ['required'],
            'file' => []
        ]);
        $files = request()->file('file');

        if (request()->hasFile('file')) {

            foreach ($files as $file) {
                $imagePath = $file->store('gallery', 'images');
                $url = Storage::disk('images')->url($imagePath);
                $gallery = $restaurant->galleries()->create([
                    'image' => $url,
                    'summary' => $data['summary']
                ]);

                // dd($gallery);
            }
        }

        return redirect()->back();
    }

    public function reviewRestaurant()
    {
        $data = request()->validate([
            'restaurant_profile_id' => [],
            "food_review" => [],
            "price_review" => [],
            "punctuality_review" => [],
            "courtesy_review" => [],
            'comment' => [],
        ]);
        $user = auth()->user();
        $customer = $user->customer_profile;
        if (!$customer)
            return redirect()->back()->with('error', 'This action is only for customers');
        $data['customer_profile_id'] = $customer->id;
        $review = $customer->reviews()->create($data);
        return redirect()->back();
    }

    public function updateProfile()
    {
        $data = request()->validate([
            'title' => [],
            'headline' => [],
            'category_id' => [],
            'location' => [],
            'city_id' => [],
            'country_id' => [],
            'phone' => [],
            'email' => [],
            'postal_address' => [],
            'logo' => [],
            'website' => [],
            'kula_points_ratio' => [],
            'delivery_fee' => [],


            
           

        ]);
        $user = auth()->user();

        // $delivery_ratio = 100 / ($data['kula_points_ratio']) ;
        // $delivery_fee = ($data['delivery_fee']);


       

        if (request()->hasFile('logo')) {
            $file = request()->file('logo');
            $imagePath = request()->file('logo')->store('logos', 'images');
            $url = Storage::disk('images')->url($imagePath);
            $imageArray = ['logo' => $url];
        }
        $user->restaurant_profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        //   $user = User::find($user->id);
       
        //   $user->restaurant_profile->update([
        //       'kula_points_ratio' => $delivery_ratio,
            
        //   ]);
        return redirect()->back()->with("success", "Changes saved successfully");
    }
}
