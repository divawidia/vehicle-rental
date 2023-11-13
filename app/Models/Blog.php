<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id','title', 'slug', 'body'
    ];

    protected $hidden = [

    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function photos(){
        return $this->hasMany(BlogPhoto::class, 'blog_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_category_details', 'blog_categories_id', 'blog_id', 'id');
    }
}

