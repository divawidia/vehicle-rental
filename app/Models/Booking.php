<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'vehicle_id',
        'pick_up_loc',
        'pick_up_datetime',
        'return_loc',
        'return_datetime',
        'insurance',
        'first_aid_kit',
        'phone_holder',
        'raincoat',
        'first_name',
        'last_name',
        'no_hp_wa',
        'email',
        'instagram',
        'facebook',
        'country',
        'home_address',
        'hotel_booking_name',
        'room_number',
        'note',
        'helmet',
        'transaction_type',
        'transaction_status',
        'transaction_code',
        'shipping_status',
        'return_status',
        'booking_status',
        'insurance_price',
        'shipping_price',
        'booking_price',
        'total_price',
        'total_fine',
        'start_km_vehicle',
        'return_km_vehicle',
        'total_km_rent',
        'vehicle_license_plate',
        'month_rent',
        'monthly_rent_price',
        'week_rent',
        'weekly_rent_price',
        'day_rent',
        'daily_rent_price',
        'total_days_rent',
        'latitude_pickup',
        'longitude_pickup',
        'latitude_return',
        'longitude_return',
        'collection_price',
        'distance_pickup',
        'rounded_distance_pickup',
        'distance_return',
        'rounded_distance_return'
    ];

    protected $hidden = [

    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
}
