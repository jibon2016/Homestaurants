<?php

namespace App\Models;

use App\Notifications\VerifyEmailForDelm;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class DeliveryMan extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasFactory, Notifiable;

    protected $guard_name = 'delivery_man';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'govt_front',
        'govt_back',
        'car_type',
        'avatar',
        'driving_license',
        'car_license',
        'delm_address',
        'delm_latitude',
        'delm_longitude',
        'approval_status',
        'dial_code',
        'whatsapp_number',
        'is_email_verified',
        'bank_name',
        'account_number',
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


     // Delivery Man search scope filter for admin
     public function scopeFilterForAdminDelm($query, array $filters) {
        if ($filters['search'] ?? false ) {
            $query->where('email', 'like', '%' . request('search') . '%')
                  ->orWhere('approval_status', 'like', '%' . request('search') . '%')
                  ->orWhere('delm_address', 'like', '%' . request('search') . '%')
                  ->orWhere('phone', 'like', '%' . request('search') . '%');
        }
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    // Filter nearby deliveryMan from vendor panel
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

        $haversine = "(6371 * acos(cos(radians($lat)) * cos(radians(delm_latitude)) * cos(radians(delm_longitude) - radians($lng)) + sin(radians($lat)) * sin(radians(delm_latitude))))";
        return $query->select('delivery_men.*')
            ->selectRaw("{$haversine} AS distance")
            ->whereRaw("{$haversine} < ?", [$radius])
            ->orderBy('distance');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailForDelm);
    }
}
