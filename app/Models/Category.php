<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function subCategories(){
        return $this->hasMany(SubCategory::class,'category_id');
    }
    public function hasSubcategory(){
        return (bool) $this->subCategories()->count();
    }
    public function raws()
    {
        return $this->hasMany(Raw::class,'category_id');
    }
    public function HasRaws()
    {
        return  (bool) $this->raws()->count();
    }
    public function rawStocks()
    {
        return $this->hasMany(RawStock::class,'category_id');
    }
    public function rawStocksGroup($type)
    {
        return $this->rawStocks()->where('type',$type)->groupBy('raw_id')->get();
    }
    public function rawStocksList($type,$raw)
    {
        return $this->rawStocks()->where('type',$type)->where('raw_id',$raw)->get();
    }
}
