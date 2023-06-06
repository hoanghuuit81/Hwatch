<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = "favorites";
    protected $fillable = [
        'customer_id', 'product_id',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function product(){
        return $this->belongsTo(Products::class,'product_id');
    }
}
