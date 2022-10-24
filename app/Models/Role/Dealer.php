<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dealer extends Model
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

	public function district()
	{
		return $this->belongsTo('App\Models\Location\District', 'district_id');
	}

	public function upazila()
	{
		return $this->belongsTo('App\Models\Location\Upazila', 'upazila_id');
	}

	public function agents()
	{
		return $this->hasMany('App\Models\Role\Agent', 'dealer_id');
	}

	public function distributor()
	{
		return $this->belongsTo('App\Models\Role\Distributor');
	}

	public function markets()
	{
		return $this->hasMany('App\Models\Location\Market')->orderBy('name');
	}

	public function leads()
	{
		return $this->hasMany('App\Models\Lead', 'dealer_id');
	}

	public function orders()
	{
		return $this->hasMany('App\Models\Order', 'dealer_id');
	}

	public function leadOrders()
	{
		return $this->hasManyThrough(
			'App\Models\OrderItem',
			'App\Models\Lead'
			// 'dealer_id',
			// 'lead_id',
			// 'id',
			// 'id'

		)->where('order_items.approvedby_id', '<>', null)
		->where('order_status', '<>', 'pending')
		->where('order_status', '<>', 'cancelled');
	}

	public function orderBalance()
	{
		return $this->leadOrders()->where(function($query){
			$query->where('order_status', 'processing');
			$query->orWhere('order_status', 'ready_to_ship');
			$query->orWhere('order_status', 'shipped');
			$query->orWhere('order_status', 'collected');
		})->sum('total_price');
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
    	return $this->roleByPayments()->where('payment_type', 'dealer_balance')->latest()->first();
    }

    public function createdUsers()
    {
        return $this->morphMany(User::class, 'addedby');
    }
}
