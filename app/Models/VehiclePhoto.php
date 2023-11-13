<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehiclePhoto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'vehicle_id',
        'photo_url'
    ];

    protected $hidden = [

    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
}
