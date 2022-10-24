<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    public function requisiton_items()
    {
        return $this->hasMany(RequisitionItem::class,'supplier_id');
    }
    public function rawStocks()
    {
        return $this->hasMany(RawStock::class,'supplier_id');
    }

    public function payment()
    {
        return $this->hasMany(SupplierPayment::class,'supplier_id');
    }
    public function latest_payment()
    {
        return $this->payment()->latest()->first();
    }

    public function hasRawStocks()
    {
        return (bool) $this->rawStocks()->count();
    }
    public function hasPayment()
    {
        return (bool) $this->payment()->count();
    }
    public function hasRequisitonItems()
    {
        return (bool) $this->requisiton_items()->count();
    }
    public function stockedRequesitionItms()
    {
        // return $this->requisiton_items()->with('rquisition')->whereHas('rquisition',function($q){
        //         $q->where('status','stocked');
        //     })->get();
        return $this->requisiton_items()->with('rquisition')->get();
        
    }
}
