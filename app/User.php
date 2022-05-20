<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'phone',
        'password',
        'address',
        'city', 
        'state_id', 
        'country_id',
        'user_type', 
        'email', 
        'phone',
        'balance',
        'ref_code',
        'referer',
        'subscribed',
        'profile_completed',
        'remember_token'];

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
    ];

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }
    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    public function artisan()
    {
        return $this->hasOne(Artisan::class);
    }
    
    public function registrar()
    {
        return $this->hasOne(InstituteRegistrars::class);
    }
    
    public function estateAgent($id)
    {
        return self::where(['user_type'=> 'estate_agent', 'id'=>$id])->first();
    }
    
    public function bookingclient()
    {
        return $this->hasOne(BookingClients::class);
    }
    
    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }
    
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    
}
