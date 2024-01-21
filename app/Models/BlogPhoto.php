<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPhoto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'blog_id',
        'photo_url'
    ];

    protected $hidden = [

    ];

    public function blog(){
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }
}
