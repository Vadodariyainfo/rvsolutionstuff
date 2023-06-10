<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory,Cachable, SoftDeletes;

    protected $fillable = [
        'tag','slug','meta_description'
    ];
    protected $dates = ['deleted_at'];

    // datatable count tag post
    public function post()
    {
        return $this->HasMany(PostTag::class, 'tag_id');
    }

}
