<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deliveryfee extends Model
{
    use HasFactory;
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
