<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "banners";
    protected $fillable = [
        'title','name','image','description','price','status',
    ];
}
