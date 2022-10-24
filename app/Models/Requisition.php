<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;
    public function requisition_items(){
        return $this->hasMany(RequisitionItem::class,'requisition_id');
    }
    public function user(){
       return $this->belongsTo(User::class,'user_id');
    }

    public function raw_materials(){
        return $this->requisition_items()->where('raw_type','raw');
    }
    public function packaging(){
        return $this->requisition_items()->where('raw_type','pack');
    }
    public function stationeries(){
        return $this->requisition_items()->where('raw_type','stationery');
    }
    public function supplierRequisitionItems($supplier)
    {
       return $this->requisition_items()->where('supplier_id',$supplier)->get();
    }
    public function packTempRequi()
    {
      return $this->hasMany(PackReqTemp::class,'requisition_id');
    }


}
