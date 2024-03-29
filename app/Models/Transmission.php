<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transmission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'transmission_type', 'slug'
    ];

    protected $hidden = [

    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'transmission_id', 'id');
    }
}
