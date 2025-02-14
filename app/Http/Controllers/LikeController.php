<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class LikeController extends Controller
{
     /**
     * Like a vendor.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function like(Vendor $vendor)
    {
        // Attach the vendor to the currently authenticated customer
        auth()->user()->likedVendors()->attach($vendor);

        return response()->json(['message' => 'Vendor liked']);
    }

    /**
     * Unlike a vendor.
     *
     * @param  \App\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function unlike(Vendor $vendor)
    {
        // Detach the vendor from the currently authenticated customer
        auth()->user()->likedVendors()->detach($vendor);

        return response()->json(['message' => 'Vendor unliked']);
    }


    public function getLikeCount(Vendor $vendor)
    {
        $likeCount = $vendor->likedByCustomers->count();

        return response()->json(['count' => $likeCount]);
    }
}
