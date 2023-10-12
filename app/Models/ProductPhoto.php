<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductPhoto extends Model
{
    use HasFactory;

    public function getNameAttribute($name)
    {
        if($name == null){
            $photo = asset("assets/images/products/img-".rand(0,9).".png");
        }else{
            $photo = asset(Storage::url('product_photo/'.$name)); // production code //
        }

        return $photo;
    }
}
