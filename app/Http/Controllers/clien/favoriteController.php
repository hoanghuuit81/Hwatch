<?php

namespace App\Http\Controllers\clien;

use App\Favorite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class favoriteController extends Controller
{

    public function add($id)
    {
        $customer = Auth::guard('cus')->user()->id;

        $favorite  = Favorite::all();
        foreach ($favorite as $item) {
            if ($item->product_id == $id && $item->customer_id == $customer) {
                return redirect()->back()->with('addFavorite','Thêm vào sản phẩm yêu thích thành công');
            }
        }

        Favorite::create([
            'customer_id' => $customer,
            'product_id' => $id
        ]);

        return redirect()->back()->with('addFavorite','Thêm vào sản phẩm yêu thích thành công');
    }

    public function list(){

        
            
        $customer = Auth::guard('cus')->user()->id;
        $favorites = Favorite::where('customer_id',$customer)->orderBy('id','DESC')->paginate(4);
        return view('clien.pages.favorite.list',compact('favorites'));
    }

    public function delete($id){
        $favorite = Favorite::find($id);
        $favorite->delete();
        return redirect()->route('clien.favoriteIndex');
    }
}
