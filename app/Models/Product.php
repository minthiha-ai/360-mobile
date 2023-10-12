<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','price','stock','size','detail','category_id','brand_id'];

    public function Category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function Brand()
    {
        return $this->belongsTo(Brand::class)->withTrashed();
    }

    public function Photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function OrderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

//    public function getStockAttribute($value)
//    {
//        return $value == 0 ? 'OUT OF STOCK' : $value;
//    }



}
