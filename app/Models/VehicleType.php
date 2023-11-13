<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'vehicle_type_name', 'slug', 'icon'
    ];

    protected $hidden = [

    ];
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'vehicle_type_id', 'id');
    }
}
