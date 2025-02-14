<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\VendorProfileUpdateRequest;
use App\Models\Chef;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class VendorProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('vendors.profile.edit', [
            'vendor' => $request->user(),
        ]);
    }

    public function update(VendorProfileUpdateRequest $request): RedirectResponse
    {
        $vendor = $request->user();

        $vendor->name = $request->input('name');
        $vendor->phone = $request->input('phone');
        $vendor->vendor_name = $request->input('vendor_name');
        $vendor->dial_code = $request->input('dial_code');
        $vendor->whatsapp_number = $request->input('whatsapp_number');

        // create or update on chefs table
        $vendor->chef->profession = $request->input('profession');
        $vendor->chef->facebook_link = $request->input('facebook_link');
        $vendor->chef->twitter_link = $request->input('twitter_link');
        $vendor->chef->instagram_link = $request->input('instagram_link');
        $vendor->chef->linkedin_link = $request->input('linkedin_link');
        $vendor->chef->youtube_link = $request->input('youtube_link');
        $vendor->chef->description = $request->input('description');

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = $avatar->store('avatars', 'public');
            $vendor->avatar = $avatarPath;
        }

        if ($request->hasFile('cover_photo')) {
            $cover_photo = $request->file('cover_photo');
            $coverPath = $cover_photo->store('profiles', 'public');
            $vendor->cover_photo = $coverPath;
        }

        $vendor->save();
        $vendor->chef->save();

        return Redirect::route('vendor.profile.edit')->with('success', 'Your profile updated successfully!');
    }

    // Show chef details
    public function chefDetails($id) {
        $vendor_chef_detail = Vendor::findOrFail($id);
        //dd($id);

       // $chef = Chef::where('vendor_id', $id)->get();
        //dd($chef);

        return view('chef-details', ['vendor_chef_detail' => $vendor_chef_detail]);
    }
}
