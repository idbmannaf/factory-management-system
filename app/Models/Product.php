<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    public function sample()
    {
        return $this->belongsTo(Sample::class, 'sample_id');
    }

    public function product_materials()
    {
        return $this->hasMany(ProductMaterial::class, 'product_id')->where('type', 'raw');
    }

    public function materials()
    {
        return $this->hasMany(ProductMaterial::class, 'product_id');
    }

    public function pack_product_materials()
    {
        return $this->materials()->where('type', 'pack');
    }
    public function raw_product_materials()
    {
        return $this->materials()->where('type', 'raw');
    }
    public function stationary_product_materials()
    {
        return $this->materials()->where('type', 'stationary');
    }
    public function afterProccessProduct()
    {
        return $this->hasMany(AfterProccessProduct::class, 'product_id');
    }
    public function afterProccessPackagingProduct()
    {
        return $this->afterProccessProduct()->where('status', 'packaging')->first();
    }

    public function tempPackagingItems()
    {
        return $this->hasMany(TempPackagingMandotoryItem::class, 'product_id')->where('user_id', Auth::id());
    }
    public function tempPackagingMandetoryitem($item)
    {
        return (bool) $this->tempPackagingItems()->where('stock_id', $item)->first();
    }
    // public function pack_stocks()
    // {
    //     return $this->hasMany(RawStock::class,'raw_id')->where('total_quantity','>',0)->where('type','pack');
    // }

}
