<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Models\Language;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tutorial extends Model
{
    use HasFactory,Cachable, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['language_id','topic_name','slug','description','example_demo','html_code','css_code','js_code','sort','meta_title','meta_description'];

    // tutorial get all details in languages
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
