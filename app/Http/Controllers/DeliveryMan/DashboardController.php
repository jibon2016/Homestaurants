<?php

namespace App\Http\Controllers\DeliveryMan;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\RiderWithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    // After login it will enter this dashboard
    public function dashboard() {
        $delmId = Auth::guard('delivery_man')->user()->id;
        $totalDeliveredItems = OrderItem::where('delivery_men_id', $delmId)->where('delm_response', 'delivered')->get()->count();
        $deliveredAmount = OrderItem::where('delivery_men_id', $delmId)->where('delm_response', 'delivered')->sum('price');
        //dd($deliveredAmount);
        $youEarned = OrderItem::where('delivery_men_id', $delmId)->where('delm_response', 'delivered')->sum('delivery_charge');
        //dd($youEarned);
        $totalWithdraw = RiderWithdrawRequest::where('delivery_man_id', $delmId)->sum('request_amount');
        return view('delm.dashboard',
        //compact('totalDeliveredItems', 'deliveredAmount', 'youEarned')
        [
            'totalDeliveredItems' => $totalDeliveredItems,
            'deliveredAmount' => $deliveredAmount,
            'youEarned' => $youEarned,
            'timePeriod' => 'daily',
            'totalWithdraw' => $totalWithdraw,
        ]
    );
    }

    public function filter(Request $request) {
        $timePeriod = $request->input('time_period');
        $userId = Auth::id();  // Assuming the delivery man and vendor use the same User model

        // Calculate the start and end dates for the selected time period
        $startDate = Carbon::now();
        $endDate = Carbon::now();
        if ($timePeriod === 'weekly') {
            $startDate->startOfWeek();
            $endDate->endOfWeek();
        } elseif ($timePeriod === 'monthly') {
            $startDate->startOfMonth();
            $endDate->endOfMonth();
        } elseif ($timePeriod === 'yearly') {
            $startDate->startOfYear();
            $endDate->endOfYear();
        }

        // Calculate filtered data based on the selected time period
        $totalDeliveredItems = OrderItem::where('delivery_men_id', $userId)->where('delm_response', 'delivered')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->count();

        $deliveredAmount = OrderItem::where('delivery_men_id', $userId)->where('delm_response', 'delivered')
            ->whereBetween('created_at', [$startDate, $endDate])->where('delm_response', 'delivered')
            ->sum('price');

        $youEarned = OrderItem::where('delivery_men_id', $userId)->where('delm_response', 'delivered')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('delivery_charge');
        $totalWithdraw = RiderWithdrawRequest::where('delivery_man_id', $userId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('request_amount');

        return view('delm.dashboard', compact('totalDeliveredItems', 'deliveredAmount', 'youEarned', 'timePeriod', 'totalWithdraw'));
    }

    // Send withdraw request
    public function riderWithdraw(Request $request) {
        $delmId = Auth::guard('delivery_man')->user()->id;
        $formFields = $request->validate([
            'request_amount' => ['required', 'numeric', 'min:10'],
            //'status' => 'required',
        ]);

        $formFields['delivery_man_id'] = $delmId;

        RiderWithdrawRequest::create($formFields);

        return redirect()->back()->with('message', 'Withdraw request sent successfully!');
    }
}
