<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    protected $fillable = [
        'name','product_id','email','content','status',
    ];

    public function product(){
        return $this->belongsTo(Products::class,'product_id');
    }
}
