<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category_blog extends Model
{
    use SoftDeletes;
    protected $table = "category_blogs";
    protected $fillable = [
        'name', 'status', 
    ];

    public function blogs(){
        return $this->hasMany(Blog::class,'cate_blog_id');
    }
}
