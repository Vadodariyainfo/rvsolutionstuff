<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostMethod extends Model
{
    use HasFactory,Cachable, SoftDeletes;

    protected $table = 'posts';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = ['author_id','category_id','title','seo_title','excerpt','body','image','slug','meta_description','meta_keywords','status','featured','body_html','body_css','body_js','path','total_view','is_demo','is_download'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function getTags()
    {
        return $this->hasMany(PostTag::class,'post_id');
    }
}
