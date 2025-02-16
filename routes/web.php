<?php
namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//use phpDocumentor\Reflection\Location;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [LandingPageController::class, 'index'])->name('landing');
// Some info pages
Route::get('/about-us', function(){
    return view('about-us');
})->name('about-us');
Route::get('privacy-policy', function(){
    return view('privacy-policy');
})->name('privacy-policy');
Route::get('recipes', function(){
    return view('recipes');
})->name('recipes');
Route::get('newsroom', function(){
    return view('newsroom');
})->name('newsroom');
Route::get('terms-conditions', function(){
    return view('terms-conditions');
})->name('terms-conditions');
Route::get('/career', function() {
    return view('career');
})->name('career');

// Mail Contact Page
Route::get('/contact-us', [ContactController::class, 'contactForm'])->name('contact');
// Define a route for the contact form submission
Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.send');

// Report submit pages
Route::get('/report', [ReportController::class, 'reportForm'])->name('report')->middleware('auth');
Route::post('/report', [ReportController::class, 'sendReport'])->name('report.send')->middleware('auth');

// Item detail page
Route::get('item-details/{food}', [FoodController::class, 'show'])->name('food-details');

//Specific vendor Foods
Route::get('vendor/{id}/foods', [FoodController::class, 'index'])->name('vendor.foods');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/location-filter', [LocationController::class, 'storeOrUpdateLocation'])->name('store-location');
// Location update from all foods page
Route::post('/foods-filter-by-location', [LocationController::class, 'storeOrUpdateLocationForFoods'])->name('update-location-on-foods-page');
Route::get('/nearby-foods', [LocationController::class, 'index'])->name('nearby.foods');
//Route::get('/nearby-vendors', [LocationController::class, 'getNearbyVendors']);

// Show chef details
Route::get('/chef-details/{id}', [VendorProfileController::class, 'chefDetails'])->name('chef.details');

Route::get('foods-groceries/{categoryId?}', [LocationController::class, 'nearbyFoods'])->name('nearby.all.foods');

// Vendor Ratings, shedules and review page
Route::get('/vendor-ratings/{id}/reviews', [VendorComponentController::class, 'vendorRatings'])->name('vendor.ratings');
Route::get('/vendor-shedules/{id}', [VendorComponentController::class, 'openCloseTimes'])->name('vendor.shedules');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Add to cart
    Route::get('cart-items', [CartController::class, 'index'])->name('cart-items');
    Route::post('add-to-cart', [CartController::class, 'store'])->middleware('verified')->name('add-to-cart');
    Route::delete('cart-delete/{cart}', [CartController::class, 'destroy'])->name('cart-remove');
    Route::put('cart-update/{cart}', [CartController::class, 'update'])->name('cart-update');

    // Order Controller routes
    Route::get('order-form', [OrderController::class, 'orderForm'])->name('order-form');
    Route::post('order-form', [OrderController::class, 'confirmOrder'])->name('confirm-order');

     // Order confirm page
     Route::get('thank-you-for-order', function(){
        return view('thank-you');
    })->name('order-success');

    // Customer orders page with review adding option
    Route::get('customer-orders', [CustomerOrderController::class, 'ordersByCustomer'])->name('customer.orders');
    Route::get('rate-food-and-delm/{orderItemId}', [CustomerOrderController::class, 'ratingsForm'])->name('rating.form');
    Route::post('rate-food-and-delm/{orderItemId}', [CustomerOrderController::class, 'createOrUpdateRating'])->name('submit.rating.form');

    // Notification manage
    Route::get('/notifications', [NotificationController::class, 'index'])->name('customer.notifications.index');
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('customer.notifications.markAsRead');
    Route::post('/notifications/mark-as-unread', [NotificationController::class, 'markAsUnread'])->name('customer.notifications.markAsUnread');
});

/** All Web Routes for Vendor
 *
 *
 * Start vendor routes
*/

// Route::get('dashboard', [Vendor\DashboardController::class, 'dashboard'])->middleware(['auth:vendor','verified' ])->name('vendor.dashboard');

Route::middleware(['auth:vendor', 'vendor.mail.verified:vendor', 'restrict.unverified.vendor'])->group(function() {
    Route::get('vendor/dashboard', [Vendor\DashboardController::class, 'dashboard'])->name('vendor.dashboard');
    Route::get('/vendor/dashboard/filter', [Vendor\DashboardController::class, 'filter'])->name('vendor.dashboard.filter');


    Route::get('vendor/plans', [PlanController::class, 'index'])->name('vendor.plans');
    Route::get('vendor/plans/{plan}', [PlanController::class, 'show'])->name('plans.show');
    Route::post('vendor/subscription', [PlanController::class, 'subscription'])->name('subscription.create');

    // Manage open and close shedule
    Route::get('/vendors/{vendor}/schedules', [Vendor\VendorScheduleController::class, 'edit'])->name('vendors.schedules.edit');
    Route::patch('/vendors/{vendor}/schedules', [Vendor\VendorScheduleController::class, 'update'])->name('vendors.schedules.update');


});

Route::middleware(['auth:vendor', 'restrict.unverified.vendor'])->prefix('vendor')->group(function() {
    // Vendor food page
    Route::get('foods', [FoodController::class, 'vendorFoods'])->name('dashboard.vendor.foods');
    Route::get('add-food', [FoodController::class, 'create'])->name('vendor.add-food');
    Route::post('add-food', [FoodController::class, 'store'])->name('vendor.store-food');
    Route::get('/edit-food/{id}', [FoodController::class, 'edit'])->name('edit.vendor-food');
    Route::put('/update-food/{id}', [FoodController::class, 'update'])->name('update.vendor-food');
    Route::delete('/delete-food/{id}', [FoodController::class, 'destroy'])->name('delete.vendor-food');

    // Create or update vendor delivery charge
    Route::post('edit-delivery-charge', [Vendor\DashboardController::class, 'createOrUpdateCharge'])->name('edit-delivery-charge');
    Route::post('update/{vendor}/bank-details', [Vendor\DashboardController::class, 'updateBankDetails'])->name('update-bank-details');
    // Create or update vendor withdraw method
    Route::post('edit-withdraw-method', [Vendor\DashboardController::class, 'createOrUpdateWithdrawAccount'])->name('edit-withdraw-account');
    // withdraw request
    Route::post('withdraw-request', [Vendor\DashboardController::class, 'withdraw'])->name('withdraw-request');

    // Vendor notifications area
    Route::get('/notifications', [Vendor\NotificationController::class, 'index'])->name('vendor.notifications.index');
    Route::post('/notifications/mark-as-read', [Vendor\NotificationController::class, 'markAsRead'])->name('vendor.notifications.markAsRead');
    Route::post('/notifications/mark-as-unread', [Vendor\NotificationController::class, 'markAsUnread'])->name('vendor.notifications.markAsUnread');

    // Vendor profile and data update
    Route::get('/profile', [VendorProfileController::class, 'edit'])->name('vendor.profile.edit');
    Route::patch('/profile', [VendorProfileController::class, 'update'])->name('vendor.profile.update');

    // Manage orders
    Route::get('orders', [Vendor\ManageOrderController::class, 'orders'])->name('vendor.orders');
    Route::get('order/{orderItem}', [Vendor\ManageOrderController::class, 'editOrder'])->name('vendor.edit.order');
    Route::put('order/{orderItem}', [Vendor\ManageOrderController::class, 'updateOrder'])->name('vendor.update.order');

});
/** End Vendor Routes */

/**
 * Web routes for delivery man
 */
Route::get('delivery-man/dashboard', [DeliveryMan\DashboardController::class, 'dashboard'])->middleware(['auth:delivery_man', 'delm.mail.verified:delivery_man'])->name('delm.dashboard');
Route::middleware(['auth:delivery_man', 'restrict.unverified.delm'])->prefix('delm')->group(function () {

    Route::get('/delivery-man/dashboard/filter', [DeliveryMan\DashboardController::class, 'filter'])->name('delm.dashboard.filter');

    Route::get('profile/{id}', [DelmProfileController::class, 'edit'])->name('edit.delm.profile');
    Route::patch('profile', [DelmProfileController::class, 'update'])->name('update.delm.profile');

    // Delivery Man notifications area
    Route::get('/notifications', [DeliveryMan\NotificationController::class, 'index'])->name('delm.notifications.index');
    Route::post('/notifications/mark-as-read', [DeliveryMan\NotificationController::class, 'markAsRead'])->name('delm.notifications.markAsRead');
    Route::post('/notifications/mark-as-unread', [DeliveryMan\NotificationController::class, 'markAsUnread'])->name('delm.notifications.markAsUnread');
    // See orders
    Route::get('orders', [DeliveryMan\MangeOrderController::class, 'orders'])->name('delm.orders');
    Route::get('order/{orderItem}', [DeliveryMan\MangeOrderController::class, 'editOrder'])->name('delm.edit.order');
    Route::put('order/{orderItem}', [DeliveryMan\MangeOrderController::class, 'acceptOrDenyOrder'])->name('delm.update.order');

     // withdraw request
    Route::post('rider-withdraw-request', [DeliveryMan\DashboardController::class, 'riderWithdraw'])->name('rider-withdraw-request');
});

/*** End Delivery man routes */

/**
 * Restriction on unverified vendor and delivery man
 */

Route::get('vendor/univerified', [UnverifiedVendorDelmController::class, 'showMessageForVendor'])->name('unverified.vendor')->middleware('auth:vendor');
Route::get('delm/univerified', [UnverifiedVendorDelmController::class, 'showMessageForDelm'])->name('unverified.delm')->middleware('auth:delivery_man');


/** Start Admin Route */
Route::prefix('admin')->middleware(['guest', 'restrict.vendor', 'restrict.admin', 'restrict.delm'])->group(function(){
    // Admin Login Routes
    Route::get('/auth/login', [Admin\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/auth/login', [Admin\AdminAuthController::class, 'login']);
});

Route::prefix('admin')->middleware('auth:admin')->group(function() {
    Route::get('dashboard', [Admin\AdminAuthController::class, 'adminHome'])->name('admin.dashboard');
    Route::post('admin/logout', [Admin\AdminAuthController::class, 'destroy'])
                ->name('admin.logout');

    // Route for categories management
    Route::resource('category', Admin\CategoryController::class);

    // Route for vendors management
    Route::resource('vendors', Admin\VendorController::class);

    // Route for deliver men management
    Route::resource('delm', Admin\DelmController::class);

    // Route for unit name management
    Route::resource('units', Admin\UnitController::class);

});


/** End Admin Route */


/**
 * Custom email verification for different guards
 */
// Route::get('delivery-man/verify/{token}', [DeliveryMan\Auth\RegisteredUserController::class, 'verifyAccount'])
//     ->name('delm.verify'); // Add the 'signed' middleware for verifying the email verification token

// Route::get('delivery-man/resend-verification', [DeliveryMan\Auth\ResendVerificationController::class, 'show'])
//     ->name('delm.verification.resend')
//     ->middleware('auth:delivery_man'); // Add the 'auth:delivery_man' middleware to ensure the user is authenticated as delivery_man

// Route::post('delivery-man/resend-verification', [DeliveryMan\Auth\ResendVerificationController::class, 'resend'])
//     ->name('delm.verification.resend')
//     ->middleware('auth:delivery_man'); // Add the 'auth:delivery_man' middleware to ensure the user is authenticated as delivery_man

// Route::get('vendor/verify/{token}', [Vendor\Auth\RegisteredUserController::class, 'verifyAccount'])
//     ->name('vendor.verify'); // Add the 'signed' middleware for verifying the email verification token

// Route::get('vendor/resend-verification', [Vendor\Auth\ResendVerificationController::class, 'show'])
//     ->name('vendor.verification.resend')
//     ->middleware('auth:vendor'); // Add the 'auth:vendor' middleware to ensure the user is authenticated as a vendor

// Route::post('vendor/resend-verification', [Vendor\Auth\ResendVerificationController::class, 'resend'])
//     ->name('vendor.verification.resend')
//     ->middleware('auth:vendor');

// Route::get('/verification-mail-sent', function() {
//     return view('mail-send-message');
// })->name('verification-send');


/**
 * End custom verification route
 */

/**
 * bKash Payment integration
 */

 Route::group(['middleware' => ['auth', 'verified']], function () {
    // Payment Routes for bKash
    Route::get('/bkash/payment', [BkashTokenizePaymentController::class,'index']);
    Route::post('/bkash/create-payment/{price}/{order_id?}', [BkashTokenizePaymentController::class,'createPayment'])->name('bkash-create-payment');
    Route::get('/bkash/callback', [BkashTokenizePaymentController::class,'callBack'])->name('bkash-callBack');

    //search payment
    Route::get('/bkash/search/{trxID}', [BkashTokenizePaymentController::class,'searchTnx'])->name('bkash-serach');

    //refund payment routes
    Route::get('/bkash/refund', [BkashTokenizePaymentController::class,'refund'])->name('bkash-refund');
    Route::get('/bkash/refund/status', [BkashTokenizePaymentController::class,'refundStatus'])->name('bkash-refund-status');

});

require __DIR__.'/auth.php';

require __DIR__.'/vendor_auth.php';

require __DIR__.'/delivery_man_auth.php';

