<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        $location = '';
        $latitude = '';
        $longitude = '';

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

        $vendors = Vendor::all();

        return view('landing_page', compact('location', 'latitude', 'longitude', 'vendors'));
    }


}
