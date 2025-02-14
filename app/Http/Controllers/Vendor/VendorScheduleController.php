<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class VendorScheduleController extends Controller
{
    public function edit($vendorId)
    {
        $vendor = Auth::guard('vendor')->user();

        // Check if the authenticated vendor's ID matches the provided vendor ID
        if ($vendor->id != $vendorId) {
            // Handle unauthorized access, such as showing an error message or redirecting
            // For example, you can redirect to a dashboard or show an error page
            return redirect()->route('vendor.dashboard')->with('error', 'Unauthorized access.');
        }

        $schedules = $vendor->schedules;

        // For open and close checkbox
        $offDays = $vendor->schedules->pluck('off_day', 'day')->toArray();

        return view('vendors.schedules.edit', compact('vendor', 'schedules', 'offDays'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        foreach ($request->input('schedules', []) as $day => $scheduleData) {
            if (isset($scheduleData['off_day']) && $scheduleData['off_day']) {
                $vendor->schedules()->updateOrCreate(['day' => $day], ['off_day' => true]);
            } else {
                $vendor->schedules()->updateOrCreate(['day' => $day], [
                    'opening_time' => $scheduleData['opening_time'],
                    'closing_time' => $scheduleData['closing_time'],
                    'off_day' => false,
                ]);
            }
        }

        // Additional logic or redirect as needed

        return redirect()->back()->with('success', 'Schedules updated successfully!');
    }

    // // Show on navigation
    // public function showNavigation()
    // {
    //     $vendor = Vendor::find(1); // Replace with your logic to retrieve the vendor

    //     return view('layouts.vendor-navigation', compact('vendor'));
    // }

}
