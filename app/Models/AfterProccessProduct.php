<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AfterProccessProduct extends Model
{
    use HasFactory;
    protected $fillable= ['status'];
    public function product()
    {
       return $this->belongsTo(Product::class,'product_id');
    }
    public function afterProccessProductMaterials()
    {
       return $this->hasMany(AfterProccessProductMaterial::class,'after_proccess_product_id');
    }
    public function total_stock($product,$unit)
    {
        // dd($this->where('product_id',$product));
    }
}
