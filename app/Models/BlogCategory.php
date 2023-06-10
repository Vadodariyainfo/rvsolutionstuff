<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory,Cachable, SoftDeletes;
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'name','slug','meta_description','status','image'
    ];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function post()
    {
        return $this->hasMany(BlogCategoryConnect::class, 'blog_category_id','id');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function categoryConnect()
    {
        return $this->belongsToMany(Blog::class, 'blog_category_connect');
    }
}
