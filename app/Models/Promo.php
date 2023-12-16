<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id','tag_name', 'slug'
    ];

    protected $hidden = [

    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_tag', 'tag_id', 'blog_id', 'id');
    }

}
