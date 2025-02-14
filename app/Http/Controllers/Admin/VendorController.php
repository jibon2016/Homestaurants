<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VendorStatusUpdated;
//use App\Models\Admin;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieving all vendors data
        $vendors = Vendor::orderBy('id', 'desc')->filterForAdminVendor(request(['search']))->paginate(5);
        //dd($vendors);
        $vendors->each(function ($vendor) {
            $vendor->govt_front = Storage::url($vendor->govt_front);
            $vendor->govt_back = Storage::url($vendor->govt_back);
        });

        return view('admin.vendors.index', ['vendors' => $vendors]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {

        // Update vendor approval status after revision

        $validatedData = $request->validate([

            'approval_status' => 'required',

        ]);

        $vendor->update($validatedData);

        //dd($vendor);

        // Send email notification

        //$admin = Admin::first(); // Replace with your admin user retrieval logic

        Notification::send($vendor, new VendorStatusUpdated($vendor));


        return redirect()->route('vendors.index')->withSuccess('You have successfully updated vendor status!');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendors.index')->withSuccess('Vendor Deleted Successfully');
    }
}
