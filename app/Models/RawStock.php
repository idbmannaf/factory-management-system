<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawStock extends Model
{
    use HasFactory;
    public function requisition(){
        return $this->belongsTo(Requisition::class,'requisition_id');
    }
    public function raw()
    {
       return $this->belongsTo(Raw::class,'raw_id');
    }
    public function category()
    {
       return $this->belongsTo(Category::class, 'category_id');
    }
    public function supplier()
    {
       return $this->belongsTo(Supplier::class,'supplier_id');
    }
    public function rawStockModifyHistory(){
        return $this->hasMany(RawStockModifyHistory::class,'stock_id')->orderBy('id','desc');
    }
    public function hasStockModifyHistory(){
        return (bool) $this->rawStockModifyHistory()->count();
    }

    public function medicineType()
    {
       return $this->belongsTo(Category::class,'raw_cat_id')->where('type','raw');
    }

    public function packCat()
    {
       return $this->belongsTo(Category::class,'pack_cat_id')->where('type','pack');
    }
    public function dhplCat()
    {
        return $this->belongsTo(DhplCategory::class,  'dhpl_cat_id');
    }
}
