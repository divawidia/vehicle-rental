<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'vehicle_id', 'plate_number', 'odometer', 'status'
    ];

    protected $hidden = [

    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
}
