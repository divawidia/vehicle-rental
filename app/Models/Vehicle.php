<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'vehicle_type_id',
        'brand_id',
        'transmission_id',
        'vehicle_name',
        'slug',
        'description',
        'features',
        'body',
        'passenger',
        'fuel_capacity',
        'fuel_type',
        'engine_capacity',
        'fuel_economy',
        'year',
        'color',
        'daily_price',
        'weekly_price',
        'monthly_price',
        'unit_quantity',
    ];

    protected $hidden = [

    ];

    public function photos(){
        return $this->hasMany(VehiclePhoto::class, 'vehicle_id', 'id');
    }

    public function vehicle_type(){
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id');
    }

    public function brand(){
        return $this->belongsTo(VehicleBrand::class, 'brand_id', 'id');
    }

    public function transmission(){
        return $this->belongsTo(Transmission::class, 'transmission_id', 'id');
    }
}
