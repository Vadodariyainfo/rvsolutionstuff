<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class PostTag extends Model
{
    use HasFactory, Cachable;

    protected $table = 'post_tags';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'post_id','tag_id', 
    ];

    // get tag in post modult to update
    public function tags()
    {
        return $this->belongsTo(Tag::class,'tag_id');
    }
}
