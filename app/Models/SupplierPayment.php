<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class,'payment_by');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
}
