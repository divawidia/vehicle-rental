<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'photo_url'
    ];

    protected $hidden = [

    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
