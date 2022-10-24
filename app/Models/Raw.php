<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Raw extends Model
{
    use HasFactory;
    public function raw_stocks()
    {
        return $this->hasMany(RawStock::class, 'raw_id')->where('total_quantity', '>', 0);
    }
    public function total_stock()
    {
        return $this->raw_stocks()->sum('total_quantity');
    }
    public function total_batch()
    {
        return $this->raw_stocks()->count();
    }

    public function firstBatch()
    {
        return $this->raw_stocks()->first();
    }
    public function secondBatch()
    {
        return $this->raw_stocks()->skip(1)->first();
    }
    public function thirdBatch()
    {
        return $this->raw_stocks()->skip(2)->first();
    }
    public function hasRawStocks()
    {
        return $this->raw_stocks()->count();
    }
    public function totalBatchQuantity()
    {
        $total_quantity = ($this->firstBatch() ? $this->firstBatch()->total_quantity : 0) + ($this->secondBatch() ? $this->secondBatch()->total_quantity : 0) + ($this->thirdBatch() ? $this->thirdBatch()->total_quantity : 0);
        return $total_quantity;
    }
    public function pack_stocks()
    {
        return $this->hasMany(RawStock::class, 'raw_id')->where('total_quantity', '>', 0)->where('type', 'pack');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function medicine()
    {
        return $this->belongsTo(Category::class, 'raw_cat_id');
    }
    public function temp_pack_requisition()
    {
        return $this->hasMany(PackReqTemp::class, 'pack_id');
    }
    public function dhplCat()
    {
        return $this->belongsTo(DhplCategory::class,  'dhpl_cat_id');
    }
    // public function HasTempItem()
    // {
    //     return (bool) $this->temp_pack_requisition()->where('user_id',Auth::id())->first();
    // }



    public function rawStockList($type)
    {
        return $this->hasMany(RawStock::class, 'raw_id')->where('type', $type)->get();
    }
    public function rawStockTotalQuantity($type)
    {
        return $this->hasMany(RawStock::class, 'raw_id')->where('type', $type)->sum('total_quantity');
    }
    public function rawStockTotalprice($type)
    {
        return $this->hasMany(RawStock::class, 'raw_id')->where('type', $type)->sum('final_price');
    }

    //    public function secondRawStock($muliply){
    //       return $this->raw_stocks()->where('unit_price','>=',$muliply)->skip(1)->take(1)->first();
    //    }
}
