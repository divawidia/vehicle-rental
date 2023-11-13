<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleBrand extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'brand_name', 'slug'
    ];

    protected $hidden = [

    ];
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'brand_id', 'id');
    }
}
