<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPackagingMandotoryItem extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->hasMany(TempPackagingMandotoryItemLists::class,'temp_packaging_id');
    }
    public function checked_items()
    {
        return $this->items()->where('checked',true)
        ->where('qty','!=',null)
        ->where('temp_packaging_id','!=',null)
        ->get();
    }
    public function stock()
    {
        return $this->belongsTo(RawStock::class,'stock_id');
    }

}
