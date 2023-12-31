<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;



    public function User()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class)->with('product');
    }
}
