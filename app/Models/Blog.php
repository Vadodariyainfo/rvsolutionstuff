<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory;
use App\Models\BlogCategoryConnect;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory,Cachable, SoftDeletes;

    protected $fillable = [
        'user_id','title','slug','body','meta_description','image','total_view','is_publish','publish_date','is_featured'
    ];
    protected $dates = ['deleted_at'];

    // get blog category data in index table
    public function blogCategoryConnect()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_category_connect');
    }

    // count releated blog
    public function relatedBlog()
    {
        return $this->hasOne(RelatedBlog::class, 'blog_id','id');
    }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_category_connect','blog_id');
    }
}
