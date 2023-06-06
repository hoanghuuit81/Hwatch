<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    protected $table = "blogs";
    protected $fillable = [
        'title_blog','author','image','content','cate_blog_id','status',	
    ];

    public function CateBlog(){
        return $this->belongsTo(Category_blog::class,'cate_blog_id');
    }
}
