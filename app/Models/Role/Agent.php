<?php

namespace App\Models\Role;

use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Ecommerce\EcommercePaymentCollection;
use App\Models\Ecommerce\EcommerceProduct;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\ShipmentReturn;
use App\Models\SrCommission;
use App\Models\SrLocation;
use App\Models\SrSalary;
use App\Models\User;
use DB;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
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

    public function dealer()
    {
        return $this->belongsTo('App\Models\Role\Dealer', 'dealer_id');
    }

    public function distributor()
    {
        return $this->belongsTo(Distributor::class, 'distributor_id');
    }

    public function depo()
    {
        return $this->belongsTo(Depo::class, 'depo_id');
    }

    public function markets()
    {
        return $this->hasMany('App\Models\Location\Market', 'agent_id');
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
        return $this->roleByPayments()->where('payment_type', 'agent_balance')->latest()->first();
    }

    public function orders()
    {
        return $this->hasMany(EcommerceOrder::class, 'agent_id')->with('items', 'orderForUser', 'orderForSource');
    }


    public function createdSources()
    {
        return $this->hasMany(EcommerceSource::class, 'agent_id');
    }

    public function createdUsers()
    {
        return $this->morphMany(User::class, 'addedby');
    }

    public function commissions()
    {
        return $this->hasMany(SrCommission::class, 'agent_id');
    }

    public function commissionByProduct($productId)
    {
        $product = EcommerceProduct::find($productId);
        
        $commission = $this->commissions()->where('category_id', $product->category_id)->pluck('commission')->first();
        if (!$commission) {
            $commission = $product->category->sr_commission;
        }
        return $commission;
    }

    public function collections()
    {
        return $this->hasMany(EcommercePaymentCollection::class, 'agent_id');
    }
    public function returns()
    {
        return $this->hasMany(ShipmentReturn::class, 'agent_id');
    }
    
    public function srLocations()
    {
        return $this->hasMany(SrLocation::class, 'agent_id');
    }
    
    public function salaries()
    {
        return $this->hasMany(SrSalary::class, 'agent_id');
    }



}
