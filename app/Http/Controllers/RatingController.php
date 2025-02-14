<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Rating;

class RatingController extends Controller
{
    // Rating by customer
    public function store(Request $request, Vendor $vendor)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        $rating = new Rating();
        $rating->vendor_id = $vendor->id;
        $rating->user_id = auth()->user()->id;
        $rating->rating = $request->input('rating');
        $rating->comment = $request->input('comment');
        $rating->save();

        return redirect()->back()->with('success', 'Rating submitted successfully.');
    }
}
