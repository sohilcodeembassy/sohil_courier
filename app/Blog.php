<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function blog_category()
    {
        return $this->belongsTo('App\Blog_category', 'blog_category_id');
    }
}
