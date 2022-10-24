<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AfterProccessProductMaterial extends Model
{
    use HasFactory;
    public function raw()
    {
      return $this->belongsTo(Raw::class,'raw_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
