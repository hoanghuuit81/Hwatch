<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;
    protected $table = "customers";
    protected $fillable = [
        'name', 'email','email_verified_at', 'password', 'phone','address',
    ];

    public function orders(){
        return $this->hasMany(Order::class,'customer_id');
    }
    
}
