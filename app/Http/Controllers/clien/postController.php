<?php

namespace App\Http\Controllers\clien;

use App\Blog;
use App\Category_blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function index(Request $req){

        $key = '';
        if($req->has('key')){
            $key = $req->input('key');
        }
        $blogs = Blog::where('status',1)->where('title_blog','LIKE',"%{$key}%")->orderBy('id','DESC')->paginate(6);
        $cateBlogs = Category_blog::where('status',1)->orderBy('id','DESC')->get();
        $recentPosts = Blog::where('status',1)->orderBy('id','DESC')->limit(5)->get();

        return view('clien.pages.blog.list',compact('blogs','cateBlogs','recentPosts'));
    }

    public function postByCate($id){
        $blogs = Blog::where('status',1)->where('cate_blog_id',$id)->orderBy('id','DESC')->paginate(6);
        $cateBlogs = Category_blog::where('status',1)->orderBy('id','DESC')->get();
        $recentPosts = Blog::where('status',1)->orderBy('id','DESC')->limit(5)->get();

        return view('clien.pages.blog.list',compact('blogs','cateBlogs','recentPosts'));
    }

    public function blogDetail($id){
        $blog = Blog::find($id);
        $cateBlogs = Category_blog::where('status',1)->orderBy('id','DESC')->get();
        $recentPosts = Blog::where('status',1)->orderBy('id','DESC')->limit(5)->get();
        $recentBlogs = Blog::where('status',1)->where('cate_blog_id',$blog->cate_blog_id)->orderBy('id','DESC')->get();

        return view('clien.pages.blog.detail',compact('blog','cateBlogs','recentPosts','recentBlogs'));
    }
}
