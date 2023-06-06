<?php

namespace App\Http\Controllers\clien;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Products;
use Illuminate\Http\Request;
use Psy\Command\WhereamiCommand;

class shopController extends Controller
{
    public function index(){

       
        $parentCate = Category::where('status',1)->where('parent_id',0)->orderBy('id','desc')->get();
        if( isset($_GET['sort_by']) ){
            $sort = $_GET['sort_by'];
            if($sort == 'nameAz'){
                
                $allPro = Products::where('status',1)->orderBy('name','ASC')->paginate(9);
                return view('clien.pages.shop.list',compact('allPro','parentCate'));
            }
            if($sort=='nameZa'){
                
                $allPro = Products::where('status',1)->orderBy('name','DESC')->paginate(9);
                return view('clien.pages.shop.list',compact('allPro','parentCate'));
            }
            if($sort =='priceAz'){
                
                $allPro = Products::where('status',1)->orderBy('sale_price','ASC')->paginate(9);
                return view('clien.pages.shop.list',compact('allPro','parentCate'));
            }
            if($sort =='priceZa'){               
                $allPro = Products::where('status',1)->orderBy('sale_price','DESC')->paginate(9);
                return view('clien.pages.shop.list',compact('allPro','parentCate'));
            }
            
        }else{
            $allPro = Products::where('status',1)->orderBy('id','desc')->paginate(9);
            return view('clien.pages.shop.list',compact('allPro','parentCate'));
        }
        

        

    }

    public function proByCate($id){
        $allPro = Products::where('status',1)->where('category_id',$id)->orderBy('id','desc')->paginate(9);
        $parentCate = Category::where('status',1)->where('parent_id',0)->orderBy('id','desc')->get();
        return view('clien.pages.shop.list',compact('allPro','parentCate'));
    }

    public function sortByPrice(Request $req){

        
        $minPrice = floatval($req->input('min-price'));
        $maxPrice = floatval($req->input('max-price'));

        $allPro = Products::where('status',1)->whereBetween('sale_price', [$minPrice*1000000, $maxPrice*1000000])->orderBy('id','desc')->paginate(9);
        $parentCate = Category::where('status',1)->where('parent_id',0)->orderBy('id','desc')->get();
        return view('clien.pages.shop.list',compact('allPro','parentCate'));
    }

    public function productDetail($id,Request $req){
        $pro = Products::find($id);
        $relatedPro = Products::where('status',1)->where('category_id',$pro->category_id)->orderBy('id','desc')->get();
        $allPro = Products::where('status',1)->orderBy('id','desc')->get();
        $comments = Comment::where('status',1)->where('product_id',$id)->orderBy('id','DESC')->get();
        $url = $req->url();
        return view('clien.pages.shop.detail',compact('pro','relatedPro','allPro','url','comments'));
    }
}
