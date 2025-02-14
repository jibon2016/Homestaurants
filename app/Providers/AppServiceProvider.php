<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Vendor;
use Laravel\Cashier\Cashier;
use Illuminate\Support\Facades\View;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Cashier::useCustomerModel(Vendor::class);

        // Show cart numbers where main layouts file is included
        View::composer(['layouts.main', 'layouts.landing', 'layouts.navigation'], function ($view) {
            $userId = auth()->id();
            $cartNumbers = Cart::where('user_id', $userId)->sum('quantity');
            $view->with('cartNumbers', $cartNumbers);
        });

        // Notifications count for vendor
        View::composer(['vendors.vendor-footer'], function ($view) {
            $userId = Auth::guard('vendor')->id();
            $unreadNotifications = 0;

            if ($userId) {
                $unreadNotifications = Auth::guard('vendor')->user()->unreadNotifications->count();
            }

            $view->with('unreadNotifications', $unreadNotifications);
        });

        // Notification count for delivery man
        View::composer(['delm.delm-footer'], function ($view) {
            $userId = Auth::guard('delivery_man')->id();
            $unreadNotifications = 0;

            if ($userId) {
                $unreadNotifications = Auth::guard('delivery_man')->user()->unreadNotifications->count();
            }

            $view->with('unreadNotifications', $unreadNotifications);
        });

         // Notification count for customer
         View::composer(['components.flowbite-footer'], function ($view) {
            $userId = Auth::guard('web')->id();
            $unreadNotifications = 0;

            if ($userId) {
                $unreadNotifications = Auth::guard('web')->user()->unreadNotifications->count();
            }

            $view->with('unreadNotifications', $unreadNotifications);
        });
    }
}
