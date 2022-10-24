<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMaterial extends Model
{
    use HasFactory;
    public function stock()
    {
      return $this->belongsTo(RawStock::class,'stock_id')->where('type','raw');
    }
    public function raw()
    {
      return $this->belongsTo(Raw::class,'raw_id')->where('type','raw');
    }
    public function package_stock()
    {
      return $this->belongsTo(RawStock::class,'stock_id')->where('type','pack');
    }
    public function package_raw()
    {
      return $this->belongsTo(Raw::class,'raw_id')->where('type','pack');
    }
}
