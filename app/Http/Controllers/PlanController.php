<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;

class PlanController extends Controller
{
    // Show all subscription plan
    public function index() {

        $plans = Plan::get();
        return view('plans', compact('plans'));
    }

    // Create a method for choose plan button
    public function show(Plan $plan, Request $request){

        $intent = auth('vendor')->user()->createSetupIntent();

        return view('subscription', compact('plan', 'intent'));
    }

     // Create subscription
    public function subscription(Request $request)
    {
        $plan = Plan::find($request->plan);

        if ($plan->price === 0) {
            $vendor = $request->user('vendor');
            $vendor->newSubscription($request->plan, $plan->stripe_plan)->create();
            return view('subscription_success');
        } else {
            // Handle paid subscription logic using Laravel Cashier
            $vendor = $request->user('vendor');
            //dd($vendor);
            //dd($request->all(), auth()->guard('vendor')->user());
            $subscription = $vendor->newSubscription($request->plan, $plan->stripe_plan)->create($request->token);
            return view('subscription_success');
        }
    }

}
