<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class FrontSetting extends Model
{
    use HasFactory, Cachable;

    protected $fillable = [
        'type','slug','value'
    ];

    // public function getFrontSetting()
    // {
    //     $data = FrontSetting::get()->toArray();
    //     $result = [];
    //     foreach ($data as $key => $value) {
    //         $result[$value['slug']] = $value;
    //     }
    //     return $result;
    // }

    // public function updateFrontSetting($input)
    // {
    //     foreach ($input as $key=>$value){
    //        FrontSetting::where('slug',$key)->update(array('value'=>$value));  
    //     }
    //     return;
    // }
}
