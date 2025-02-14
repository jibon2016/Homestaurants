<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use App\Models\Food;
use App\Notifications\VerifyEmailForVendor;

class Vendor extends Authenticatable implements MustVerifyEmail
{

    use HasFactory, Notifiable, Billable;

    protected $guard = 'vendor';

    protected $table = 'vendors';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'cover_photo',
        'vendor_name',
        'govt_front',
        'govt_back',
        'country',
        'currency',
        'vendor_address',
        'vendor_latitude',
        'vendor_longitude',
        'approval_status',
        'dial_code',
        'whatsapp_number',
        'current_utility_bill',
    ];

     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Create vendors nearby scope filter
    public function scopeNearby(Builder $query, $latLng, $radius)
    {
        if (!$latLng) {
            return $query;
        }

        [$lat, $lng] = explode(',', $latLng);
        if (!$lat || !$lng) {
            return $query;
        }

        $haversine = "(6371 * acos(cos(radians($lat)) * cos(radians(vendor_latitude)) * cos(radians(vendor_longitude) - radians($lng)) + sin(radians($lat)) * sin(radians(vendor_latitude))))";
        return $query->select('vendors.*')
            ->selectRaw("{$haversine} AS distance")
            ->whereRaw("{$haversine} < ?", [$radius])
            ->orderBy('distance');
    }

    // Vendor search scope filter for admin
    public function scopeFilterForAdminVendor($query, array $filters) {
        if ($filters['search'] ?? false ) {
            $query->where('email', 'like', '%' . request('search') . '%')
                  ->orWhere('approval_status', 'like', '%' . request('search') . '%')
                  ->orWhere('vendor_address', 'like', '%' . request('search') . '%')
                  ->orWhere('phone', 'like', '%' . request('search') . '%');
        }
    }


    // Maintain vendor open and close time relationship
    public function schedules()
    {
        return $this->hasMany(VendorSchedule::class);
    }

    // Vendor foods
    public function foods() {
        return $this->hasMany(Food::class);
    }

    // One Delivery charge

    public function deliveryCharge()
    {
        return $this->hasOne(DeliveryCharge::class);
    }

    // Retlationship with Rating
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // One withdraw account

    public function withdrawAccount()
    {
        return $this->hasOne(DeliveryCharge::class);
    }

    public function withdrawRequests() {
        return $this->hasMany(WithdrawRequest::class);
    }

    // // Polymorphic relationship for notifications
    // public function notifications()
    // {
    //     return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    // } created issues because

    public function chef() {
        return $this->hasOne(Chef::class);
    }

    public function likedByCustomers()
    {
        return $this->belongsToMany(User::class, 'customer_vendor_likes', 'vendor_id', 'customer_id');
    }

    // Show offer badge
    public function offerBadge() {
        return $this->hasOne(OfferBadge::class);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailForVendor);
    }
}
