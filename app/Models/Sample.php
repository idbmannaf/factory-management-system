<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;
    public function sample_items(){
        return $this->hasMany(SampleItem::class,'sample_id');
    }

    public function dhplCat()
    {
        return $this->belongsTo(DhplCategory::class,  'dhpl_cat_id');
    }
    public function dhplProduct()
    {
        return $this->belongsTo(DhplProduct::class,  'dhpl_product_id');
    }

}
