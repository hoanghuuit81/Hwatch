<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_details";
    protected $fillable = [
        'order_id','product_id','quantity','price','subtotal',
    ];

    public function product(){
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
