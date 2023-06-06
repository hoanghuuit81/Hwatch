<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    protected $table = "products";
    protected $fillable = [
        'name','price','sale_price','image','status','category_id','description','bestSeller',	
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function detailImages(){
        return $this->hasMany(Detail_image::class,'product_id');
    }

    public function scopeSearch($query){
        if(request('key')){
            $key = request('key');
            $query = $query -> where('name','like','%'.$key.'%');
        }

        if(request('category_id')){
            $query = $query->where('category_id',request('category_id'));
        }

        return $query;
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class,'product_id');
    }
}
