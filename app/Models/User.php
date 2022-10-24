<?php

namespace App\Models;

use App\Models\Ecommerce\EcommerceCart;
use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\Role\Agent;
use App\Models\Role\Depo;
use App\Models\Role\Distributor;
use App\Scopes\ActiveScope;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'password_temp',
        'mobile',
        'mobile_country',
        'username',
        'calling_code',
        'currency_code',
        'nid',
        'addedby_type',
        'addedby_id',
        'editedby_id',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
    ];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope);
        //'active = 1'
    }

    public function mobileOrEmail()
    {
        return $this->mobile ?: $this->email;
    }


    //passport

    public function findForPassport($username)
    {
        return $this->where('mobile', $username)->first();
    }

    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }


    //passport end



//old from msbd/epl/bravo
    public function myroles()
    {
        return $this->hasMany('App\Models\Role\MyRole', 'user_id');
    }
    public function permissions()
      {
        return  $this->hasMany(MyRoleItem::class,'user_id');
      }
      public function selectRole($role)
      {
        return  $this->myroles()->where('role_name',$role)->first();
      }

    public function doesHaveRole()
    {
        if($this->myroles->count() or $this->isAdmin() or $this->isAccounts() or $this->isProduction() or $this->isPurchase() or $this->isFactotyManager() )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function isAdmin()
    {

        if($this->myroles()->where('role_name', 'admin')->first())
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function isCommonAdmin()
    {

        if($this->myroles()->where('role_name', 'common')->first())
        {
            return true;
        }
        else{
            return false;
        }
    }



    public function fiName()
    {
        if($this->img_name)
        {
            return $this->img_name;
        }
        else
        {
            return 'img/defult.png';
        }
    }

    public function hasMyRole($role) //$role = admin, staff..
    {
        if($role == 'admin' || $role == 'production' || $role=='accounts' || $role=='purchase' || $role=='factory_manager')
        {
           if($this->myroles()->where('role_name', $role)->first())
            {
                return true;
            }
            else{
                return false;
            }
        }

    }

    public function isAccounts()
    {

        if($this->myroles()->where('role_name', 'accounts')->first())
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function isProduction()
    {

        if($this->myroles()->where('role_name', 'production')->first())
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function isPurchase()
    {

        if($this->myroles()->where('role_name', 'purchase')->first())
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function isFactotyManager()
    {

        if($this->myroles()->where('role_name', 'factory_manager')->first())
        {
            return true;
        }
        else{
            return false;
        }
    }








}
