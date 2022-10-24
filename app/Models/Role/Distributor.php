<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Distributor extends Model
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

	public function dealers()
	{
		return $this->hasMany('App\Models\Role\Dealer', 'distributor_id');
	}

	public function depo()
	{
		return $this->belongsTo('App\Models\Depo', 'depo_id');
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
    	return $this->roleByPayments()->where('payment_type', 'distributor_balance')->latest()->first();
    }
}
