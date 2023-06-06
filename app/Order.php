<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
        'code_order','customer_id','total_amount','address','phone','notes','status',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class,'order_id');
    }
}
