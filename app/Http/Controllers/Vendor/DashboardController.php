<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use App\Models\DeliveryCharge;
use App\Models\OrderItem;
use App\Models\WithdrawAccount;
use App\Models\WithdrawRequest;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // Display the default dashboard
    public function dashboard() {
        $vendorId = Auth::guard('vendor')->user()->id;
        $vendor = Auth::guard('vendor')->user();
        $totalAddedFoods = Food::where('vendor_id', $vendorId)->count();
        $deliveryCharge = DeliveryCharge::where('vendor_id', $vendorId)->first();
        $withdrawAccount = WithdrawAccount::where('vendor_id', $vendorId)->first();

        // Calculate total sale, total earn, pickup money, and total withdraw for the default dashboard
        $totalSalePrice = OrderItem::where('vendor_id', $vendorId)->where('order_status', 'delivered')->sum('price');
        $totalEarn = OrderItem::where('vendor_id', $vendorId)->where('order_status', 'delivered')->sum('earn_price');
        $pickupMoney = OrderItem::where('vendor_id', $vendorId)->where('delivery_option', 0)->where('order_status', 'delivered')->sum('price');
        $totalWithdraw = WithdrawRequest::where('vendor_id', $vendorId)->sum('request_amount');

        return view('vendor.dashboard', [
            'totalAddedFoods' => $totalAddedFoods,
            'deliveryCharge' => $deliveryCharge,
            'totalSalePrice' => $totalSalePrice,
            'totalEarn' => $totalEarn,
            'pickupMoney' => $pickupMoney,
            'withdrawAccount' => $withdrawAccount,
            'totalWithdraw' => $totalWithdraw,
            'timePeriod' => 'daily',
            'vendor' => $vendor,
        ]);
    }

    // Filter method for displaying filtered data
    public function filter(Request $request) {
        $timePeriod = $request->input('time_period');
        $vendorId = Auth::guard('vendor')->user()->id;

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
        $totalAddedFoods = Food::where('vendor_id', $vendorId)->count();
        $totalSalePrice = OrderItem::where('vendor_id', $vendorId)
            ->where('order_status', 'delivered')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('price');
        $totalEarn = OrderItem::where('vendor_id', $vendorId)
            ->where('order_status', 'delivered')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('earn_price');
        $pickupMoney = OrderItem::where('vendor_id', $vendorId)
            ->where('delivery_option', 0)
            ->where('order_status', 'delivered')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('price');
        $totalWithdraw = WithdrawRequest::where('vendor_id', $vendorId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('request_amount');

        $deliveryCharge = DeliveryCharge::where('vendor_id', $vendorId)->first();
        $withdrawAccount = WithdrawAccount::where('vendor_id', $vendorId)->first();

        return view('vendor.dashboard', [
            'totalAddedFoods' => $totalAddedFoods,
            'deliveryCharge' => $deliveryCharge,
            'totalSalePrice' => $totalSalePrice,
            'totalEarn' => $totalEarn,
            'pickupMoney' => $pickupMoney,
            'withdrawAccount' => $withdrawAccount,
            'totalWithdraw' => $totalWithdraw,
            'timePeriod' => $timePeriod,
        ]);
    }

    // Create or Update delivery charge
    public function createOrUpdateCharge(Request $request)
    {
        $vendorId = Auth::guard('vendor')->user()->id;
        $deliveryCharge = DeliveryCharge::where('vendor_id', $vendorId)->first();

        $perKmCharge = $request->validate([
            'charge' => ['required', 'numeric'],
        ]);
        $perKmCharge['vendor_id'] = $vendorId;

        if ($deliveryCharge == null) {
            DeliveryCharge::create($perKmCharge);
        } else {
            $deliveryCharge->update($perKmCharge);
        }

        return redirect()->back()->with('message', 'Delivery charge updated!');
    }

    public function updateBankDetails(Request $request, Vendor $vendor)
    {
        $request->validate([
            'bank_name' => 'required',
            'bank_ac' => 'required',
            'bank_qr' => 'nullable|image|mimes:jpeg,png,jpg,jfif,webp|max:2048',
        ]);
        if($request->hasFile('bank_qr')){
            $vendor->bank_qr =  $request->file('bank_qr')->store('banks', 'public');
        }
        $vendor->bank_name = $request->bank_name;
        $vendor->bank_ac = $request->bank_ac;
        $vendor->save();
        return redirect()->back()->with('message', 'Bank details updated!');
    }


    // Create or update payment methods for withdraw request
    public function createOrUpdateWithdrawAccount(Request $request)
    {
        $vendorId = Auth::guard('vendor')->user()->id;
        $withdrawAccount = WithdrawAccount::where('vendor_id', $vendorId)->first();

        $formFields = $request->validate([
            'payment_method' => ['required', 'string'],
            'holder_name' => ['required', 'string'],
            'account_no' => ['required', 'string', 'unique:withdraw_accounts'],
            'routing_number' => ['nullable', 'string'],
        ]);
        $formFields['vendor_id'] = $vendorId;

        if ($withdrawAccount == null) {
            WithdrawAccount::create($formFields);
        } else {
            $withdrawAccount->update($formFields);
        }

        return redirect()->back()->with('message', 'Withdraw bank details updated!');
    }

    // Send withdraw request
    public function withdraw(Request $request) {
        $vendorId = Auth::guard('vendor')->user()->id;
        $formFields = $request->validate([
            'request_amount' => ['required', 'numeric', 'min:10'],
            'currency' => 'required',
            //'status' => 'required',
        ]);

        $formFields['vendor_id'] = $vendorId;

        WithdrawRequest::create($formFields);

        return redirect()->back()->with('message', 'Withdraw request sent successfully!');
    }


}
