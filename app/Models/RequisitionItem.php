<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionItem extends Model
{
    use HasFactory;

    public function raw_materials()
    {
        return $this->belongsTo(Raw::class, 'raw_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function rquisition()
    {
       return $this->belongsTo(Requisition::class,'requisition_id');
    }
    public function raw_stocks()
    {
        return $this->hasMany(RawStock::class,'raw_id','raw_id')->where('total_quantity','>',0);;
    }

    public function total_stock(){
        return $this->raw_stocks()->sum('total_quantity');
    }
    public function total_batch(){
        return $this->raw_stocks()->count();
    }
    public function firstBatch(){
        return $this->raw_stocks()->first();
    }
    public function secondBatch(){
        return $this->raw_stocks()->skip(1)->first();
    }
    public function thirdBatch(){
        return $this->raw_stocks()->skip(2)->first();
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
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
