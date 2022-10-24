<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackReqTemp extends Model
{
    use HasFactory;
    public function medicineType()
    {
        return $this->belongsTo(Category::class,'row_cat_id');
    }
    public function materials()
    {
        return $this->belongsTo(Raw::class,'pack_id');
    }
}
