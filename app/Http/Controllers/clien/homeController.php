<?php

namespace App\Http\Controllers\clien;

use App\Banner;
use App\Blog;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Order;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class homeController extends Controller
{
    public function index(){
        $banners = Banner::where('status',1)->get();
        // dd($banners);
        $allPro = Products::where('status',1)->orderBy('id','desc')->get();
        $bestSellerPro = Products::where('status',1)->where('bestSeller',1)->orderBy('id','desc')->get();
        $blogs = Blog::where('status',1)->orderBy('id','desc')->limit(3)->get();

        return view('clien.pages.home.home',compact('banners','allPro','bestSellerPro','blogs'));
    }

    public function account(){
        
        if(Auth::guard('cus')->check()){
            $orders =  Order::where('customer_id',Auth::guard('cus')->user()->id)->orderBy('id','DESC')->get();
        }else{
            $orders = 0;
        }

        return view('clien.pages.account.account',compact('orders'));
        
    }

    public function formForgetPass(){
        return view('clien.pages.account.formForgetPass');
    }

    public function sendMailForgetPass(Request $req){
        
        $req->validate(
            [
                'email' => 'required|email|exists:customers,email',                
            ],
            [
                'required' => ':attribute không được để trống',
                'email' =>':attribute không đúng định dạng',
                'exists' =>':attribute không tồn tại trên hệ thống',
                
            ],
            [

                'email' => 'Email',
            ]
        );

        $mail = $req->input('email');
        $customer = Customer::where('email',$mail)->first();
        $randomString = Str::random(15);
        $customer->update([
            'token'=> $randomString,
        ]);
        
        Mail::send('clien.pages.mail.mailFogetPass', compact('customer'), function ($email) use($customer, $mail) {
            $email->to( $mail, $customer->name);
            $email->subject('[HHwatch] Thư xác nhận lấy lại mật khẩu! ');
        });

        return view('clien.pages.account.succesMail',compact('mail'));
    }

    public function formChangePass($id,$token){
        $customer = Customer::find($id);
        if($customer->token === $token){
            return view('clien.pages.account.formChangePass',compact('customer'));
        }
    }

    public function postNewPass(Request $req, $id){
        $req->validate(
            [
                'password' => 'required',
                'confirmPass' => 'required|same:password',               
            ],
            [
                'required' => ':attribute không được để trống',
                'same' =>':attribute không đúng',  
            ],
            [

                'password' => 'Mật khẩu',
                'confirmPass' => 'Nhập lại mật khẩu',
            ]
        );

        Customer::where('id',$id)
        ->update([
            'password' => Hash::make($req->input('password')),
        ]);

        return redirect()->route('clien.login')->with('flash','Đổi mật khẩu thành công');
    }
}
