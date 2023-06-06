<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Products;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboard extends Controller
{
    public function index(){
        $totalUser = User::count();
        $totalProduct = Products::count();
        $orders = Order::all();
        $totalOrders = $orders->count();
        $totalAmount = 0;
        foreach($orders as $item){
            $totalAmount += $item->total_amount;
        }

        $orders = Order::orderBy('id','DESC')->paginate(8);
        return view('admin.pages.dashboard',compact('totalUser','totalProduct','totalOrders','totalAmount','orders'));
    }

    public function logout(){
        Auth::logout();
        return view('auth.login');
    }
}
