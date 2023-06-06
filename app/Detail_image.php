<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_image extends Model
{
    protected $table = "detail_images";
    protected $fillable = [
        'product_id','image',
    ];
}
