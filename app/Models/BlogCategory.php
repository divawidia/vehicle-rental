<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_name', 'slug'
    ];

    protected $hidden = [

    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_category_details', 'blog_id', 'blog_categories_id', 'id');
    }

}
