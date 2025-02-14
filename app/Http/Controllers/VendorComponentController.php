<?php

namespace App\Http\Controllers;

use App\Models\OfferBadge;
use App\Models\Rating;
use App\Models\Vendor;
use App\Models\VendorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorComponentController extends Controller
{
    // Vendor ratings and reviews page data
    public function vendorRatings($id) {
        $ratings_reviews = Rating::where('vendor_id', $id)->get();
        //dd($ratings_reviews);

        $total_rating = $ratings_reviews->count();

        // Initialize counters for each rating category
        $fiveStarsCount = 0;
        $fourStarsCount = 0;
        $threeStarsCount = 0;
        $twoStarsCount = 0;
        $oneStarCount = 0;

        // Loop through the ratings to count each category
        foreach ($ratings_reviews as $rating_review) {
            switch ($rating_review->rating) {
                case 5:
                    $fiveStarsCount++;
                    break;
                case 4:
                    $fourStarsCount++;
                    break;
                case 3:
                    $threeStarsCount++;
                    break;
                case 2:
                    $twoStarsCount++;
                    break;
                case 1:
                    $oneStarCount++;
                    break;
                // Handle any other cases if necessary
            }
        }

        // Calculate percentages
        $fiveStarsPercentage = ($fiveStarsCount / $total_rating) * 100;
        $fourStarsPercentage = ($fourStarsCount / $total_rating) * 100;
        $threeStarsPercentage = ($threeStarsCount / $total_rating) * 100;
        $twoStarsPercentage = ($twoStarsCount / $total_rating) * 100;
        $oneStarPercentage = ($oneStarCount / $total_rating) * 100;

        $avg_rating = $ratings_reviews->avg('rating');

        return view('vendor-ratings', compact(
            'ratings_reviews',
            'avg_rating',
            'total_rating',
            'fiveStarsPercentage',
            'fourStarsPercentage',
            'threeStarsPercentage',
            'twoStarsPercentage',
            'oneStarPercentage'
        ));
    }


    // Show vendor time and shedules
    public function openCloseTimes($id){
        $shedules = VendorSchedule::where('vendor_id', $id)->get();
        // dd($shedules);
        return view('open-close-time', compact('shedules'));
    }

    // Create or edit offer badge for vendor component
    public function editOrCreateOfferText(Request $request) {
        $vendorId = Auth::guard('vendor')->user()->id;
        $badgeLine = OfferBadge::where('vendor_id', $vendorId)->first();

        $formFields = $request->validate([
            'badge_line' => ['required', 'string', 'min:5', 'max:15'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);
        $formFields['vendor_id'] = $vendorId;

        if ($badgeLine == null) {
            OfferBadge::create($formFields);
        } else {
            $badgeLine->update($formFields);
        }

        // It will be added on the shedule page
        return redirect()->back()->with('message', 'Offer Text on the Vendor updated!');
    }

}
