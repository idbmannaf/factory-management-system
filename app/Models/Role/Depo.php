<?php

namespace App\Models\Role;

use App\Models\Ecommerce\EcommerceOrder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depo extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name','address'];

    public function user()
	{
	    return $this->belongsTo('App\Models\User', 'user_id')->withoutGlobalScopes();
	}

	public function division()
	{
		return $this->belongsTo('App\Models\Location\Division', 'division_id');
	}

	public function distributors()
	{
		return $this->hasMany('App\Models\Role\Distributor', 'depo_id');
	}

	public function roleToPayments()
    {
        return $this->morphMany('App\Models\Role\RolePayment', 'roleto');
    }

    public function roleByPayments()
    {
        return $this->morphMany('App\Models\Role\RolePayment', 'roleby');
    }

    public function lastSystemBalanceReceived()
    {
    	return $this->roleToPayments()->where('payment_type', 'system_balance')->latest()->first();
    }

    public function lastSentToSystemBalance()
    {
    	return $this->roleByPayments()->where('payment_type', 'depo_balance')->latest()->first();
    }
    public function orders(){
        return $this->hasMany(EcommerceOrder::class,'depo_id');
    }
    public function OrderCount($type){
        if ($type == 'all') {
            return $this->orders()->where('order_status', '<>', 'temp')->count();
        } elseif ($type == 'pending') {
            return $this->orders()->where('order_status', 'pending')->count();
        } elseif ($type == 'confirmed') {
            return $this->orders()->where('order_status', 'confirmed')->count();
        } elseif ($type == 'processing') {
            return $this->orders()->where('order_status', 'processing')->count();
        } elseif ($type == 'shipped') {
            return $this->orders()->where('order_status', 'shipped')->count();
        } elseif ($type == 'collected') {
            return $this->orders()->where('order_status', 'collected')->count();
        } elseif ($type == 'delivered') {
            return $this->orders()->where('order_status', 'delivered')->count();
        } elseif ($type == 'cancelled') {
            return $this->orders()->where('order_status', 'cancelled')->count();
        } elseif ($type == 'returned') {
            return $this->orders()->where('order_status', 'returned')->count();
        } elseif ($type == 'undelivered') {
            return $this->orders()->where('order_status', 'undelivered')->count();
        }
    }

}
