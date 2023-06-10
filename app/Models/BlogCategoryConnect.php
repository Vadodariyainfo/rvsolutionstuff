<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class BlogCategoryConnect extends Model
{
    use HasFactory,Cachable;
    
    protected $table = 'blog_category_connect';
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'blog_category_id','blog_id'
    ];

}