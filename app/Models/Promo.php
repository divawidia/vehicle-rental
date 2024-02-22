<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'type',
        'uses',
        'max_uses',
        'discount_amount',
        'starts_at',
        'expires_at'
    ];

    protected $hidden = [

    ];

    public function bookings(){
        return $this->hasMany(Booking::class, 'promo_id', 'id');
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'vehicle_promo', 'promo_id', 'vehicle_id', 'id');
    }

}
