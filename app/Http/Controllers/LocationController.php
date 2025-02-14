<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Vendor;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
class LocationController extends Controller
{
    // After select location
    public function index()
    {
        $location = '';

        if (auth()->check()) {
            // User is registered, retrieve the location from the database
            $user = auth()->user();
            $locationData = DB::table('user_locations')->where('user_id', $user->id)->first();

            if ($locationData) {
                $location = $locationData->location;
                $latitude = $locationData->latitude;
                $longitude = $locationData->longitude;
            }
        } else {
            // User is not registered, retrieve the location from the session
            $location = session('location', '');
            $latitude = session('latitude', '');
            $longitude = session('longitude', '');
        }


        // Now write code for getting nearby vendors
        $userId = Auth::id();

        if ($userId) {
            // User is logged in, retrieve the user's location from the database
            $userLocation = DB::table('user_locations')
                            ->where('user_id', $userId)
                            ->first();

            if ($userLocation) {
                $userLatitude = $userLocation->latitude;
                $userLongitude = $userLocation->longitude;
            }
        } else {
            // User is not logged in, retrieve the user's location from the session
            $userLatitude = session('latitude');
            $userLongitude = session('longitude');
        }

        if (!$userLatitude || !$userLongitude) {
            return "You have not selected any location from the maps!";
        }

        $latLng = $userLatitude . ',' . $userLongitude;
        $radius = 20; // Set your desired radius value here

        // When required multiple pagination in the same page
        $nearbyVendors = Vendor::nearby($latLng, $radius)->paginate(4);
        //return dd($nearbyVendors);

        // Calculate and add the distance to the vendor data
        foreach ($nearbyVendors as $vendor) {
            $vendorLatitude = $vendor->vendor_latitude;
            $vendorLongitude = $vendor->vendor_longitude;

            // Calculate the distance between the user and the vendor using the Haversine formula
            $distance = haversineDistance($userLatitude, $userLongitude, $vendorLatitude, $vendorLongitude);

            // Add the distance to the vendor's data
            $vendor->distance = $distance;
        }

        // Require for condition in blade file
        $numberOfRows = $nearbyVendors->count();

        return view('location_filter', compact(['location', 'latitude', 'longitude', 'nearbyVendors', 'numberOfRows']));
    }

    // StoreOrUpdatelocation from using this same method

    public function storeOrUpdateLocation(Request $request)
    {
        $userId = auth()->id();

        // Prevent naughty user to make fake order from different countries
        // Check if the user has items in the cart
        $cartItemCount = Cart::where('user_id', $userId)->count();

        // If the user has items in the cart, prevent updating the location
        if ($cartItemCount > 0) {
            return redirect()->back()->with('message', 'You cannot update the location once food items are added to the plate.');
        }

        // Store location data in the session if the user is not registered
        if (!$userId) {
            session([
                'location' => $request->input('location'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
            ]);
        }

        $locationData = [
            'location' => $request->input('location'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'user_id' => $userId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        if ($userId) {
            // User is registered, retrieve the location from the database
            $existingLocation = DB::table('user_locations')->where('user_id', $userId)->first();

            if ($existingLocation) {
                // Update the existing location
                DB::table('user_locations')->where('user_id', $userId)->update($locationData);
            } else {
                // Insert a new location
                DB::table('user_locations')->insert($locationData);
            }
        }

        return redirect('/nearby-foods');
    }

    // Location update from foods and groceries page

    public function storeOrUpdateLocationForFoods(Request $request)
    {
        $userId = auth()->id();

        $cartItemCount = Cart::where('user_id', $userId)->count();

        // If the user has items in the cart, prevent updating the location
        if ($cartItemCount > 0) {
            return redirect()->back()->with('restrictMessage', 'You cannot update the location once food items are added to the plate.');
        }

        // Store location data in the session if the user is not registered
        if (!$userId) {
            session([
                'location' => $request->input('location'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
            ]);
        }

        $locationData = [
            'location' => $request->input('location'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'user_id' => $userId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        if ($userId) {
            // User is registered, retrieve the location from the database
            $existingLocation = DB::table('user_locations')->where('user_id', $userId)->first();

            if ($existingLocation) {
                // Update the existing location
                DB::table('user_locations')->where('user_id', $userId)->update($locationData);
            } else {
                // Insert a new location
                DB::table('user_locations')->insert($locationData);
            }
        }

        return redirect()->back();
    }


    // public function getNearbyVendors()
    // {
    //     $userId = Auth::id();

    //     if ($userId) {
    //         // User is logged in, retrieve the user's location from the database
    //         $userLocation = DB::table('user_locations')
    //                         ->where('user_id', $userId)
    //                         ->first();

    //         if ($userLocation) {
    //             $userLatitude = $userLocation->latitude;
    //             $userLongitude = $userLocation->longitude;
    //         }
    //     } else {
    //         // User is not logged in, retrieve the user's location from the session
    //         $userLatitude = session('latitude');
    //         $userLongitude = session('longitude');
    //     }

    //     if (!$userLatitude || !$userLongitude) {
    //         return "You have not selected any location from the maps!";
    //     }

    //     $latLng = $userLatitude . ',' . $userLongitude;
    //     $radius = 20; // Set your desired radius value here

    //     $nearbyVendors = Vendor::nearby($latLng, $radius)->get();
    //     //return dd($nearbyVendors);

    //     return view('nearby_kitchen', compact('nearbyVendors'));
    //     }


    /**
     * Get nearby foods and groceries
     */
    public function nearbyFoods(Request $request, $categoryId = null, $food_name = null)
    {

        $location = '';

        if (auth()->check()) {
            // User is registered, retrieve the location from the database
            $user = auth()->user();
            $locationData = DB::table('user_locations')->where('user_id', $user->id)->first();

            if ($locationData) {
                $location = $locationData->location;
                $latitude = $locationData->latitude;
                $longitude = $locationData->longitude;
            }
        } else {
            // User is not registered, retrieve the location from the session
            $location = session('location', '');
            $latitude = session('latitude', '');
            $longitude = session('longitude', '');
        }


        // Now write code for getting nearby vendors
        $userId = Auth::id();

        if ($userId) {
            // User is logged in, retrieve the user's location from the database
            $userLocation = DB::table('user_locations')
                            ->where('user_id', $userId)
                            ->first();

            if ($userLocation) {
                $userLatitude = $userLocation->latitude;
                $userLongitude = $userLocation->longitude;
            }
        } else {
            // User is not logged in, retrieve the user's location from the session
            $userLatitude = session('latitude');
            $userLongitude = session('longitude');
        }

        if (!$userLatitude || !$userLongitude) {
            return "You have not selected any location from the maps!";
        }

        $latLng = $userLatitude . ',' . $userLongitude;
        $radius = 40; // Set your desired radius value here

        // When required multiple pagination in the same page
        $nearbyVendors = Vendor::nearby($latLng, $radius)->get();
        //return dd($nearbyVendors);

        // Calculate and add the distance to the vendor data
        foreach ($nearbyVendors as $vendor) {
            $vendorLatitude = $vendor->vendor_latitude;
            $vendorLongitude = $vendor->vendor_longitude;

            // Calculate the distance between the user and the vendor using the Haversine formula
            $distance = haversineDistance($userLatitude, $userLongitude, $vendorLatitude, $vendorLongitude);

            // Add the distance to the vendor's data
            $vendor->distance = $distance;
        }


        // Collecting nearbyfood items
        $foodQuery = Food::whereIn('vendor_id', $nearbyVendors->pluck('id'));
        //return dd($nearbyFoodItems);

        // Require for condition in blade file
        $numberOfRows = $nearbyVendors->count();

        // Total fooditems
        $foodTotals = Food::whereIn('vendor_id', $nearbyVendors->pluck('id'))->get();

        // Get vendor food categories
        $nearVendorFoodCategories = $foodTotals->pluck('category.id','category.name')->unique();
        //return dd($nearVendorFoodCategories);

        // Apply category filter if requested

        // $categoryId = $request->input('category');
        // $food_name = $request->input('food_name');
        // if ($categoryId || $food_name) {
        //     $foodQuery =  $foodQuery->where('category_id', $categoryId)->orWhere('food_name', 'like', '%' .$food_name. '%');
        // }

        // $nearbyFoodItems = $foodQuery->paginate(8); error: vendor_name null

        $categoryId = $request->input('category');
        $food_name = $request->input('food_name');

        $selectedCategory = $categoryId ?? null; // Store the selected category ID, or null if not provided

        $foodQuery = Food::whereIn('vendor_id', $nearbyVendors->pluck('id'));

        if ($categoryId || $food_name) {
            $foodQuery = $foodQuery->where(function ($query) use ($categoryId, $food_name) {
                if ($categoryId) {
                    $query->where('category_id', $categoryId);
                }
                if ($food_name) {
                    $query->where('food_name', 'like', '%' . $food_name . '%');
                }
            });
        }

        $nearbyFoodItems = $foodQuery->paginate(8);


        return view('foods_groceries', compact(['location', 'latitude', 'longitude',
                      'nearbyVendors', 'numberOfRows',
                      'categoryId', 'nearbyFoodItems',
                      'nearVendorFoodCategories',
                      'selectedCategory',
                      'food_name']));

    }

}
