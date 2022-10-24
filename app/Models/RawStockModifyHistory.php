<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawStockModifyHistory extends Model
{
    use HasFactory;
    public function raw(){
        return $this->belongsTo(Raw::class,'raw_id');
    }
}
