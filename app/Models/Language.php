<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use HasFactory,Cachable, SoftDeletes;

    protected $fillable = ['name','slug','description','meta_title','meta_description','image'];
    protected $dates = ['deleted_at'];

    // get front tutorial language data get
    public function tutorials()
    {
        return $this->hasMany(Tutorial::class, 'language_id','id');
    }
}
