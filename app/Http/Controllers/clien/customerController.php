<?php

namespace App\Http\Controllers\clien;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class customerController extends Controller
{
    public function login(){
        return view('clien.pages.account.login');
    }

    

    public function postLogin(Request $req){
        $req->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            
                
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' =>':attribute đã tồn tại trên hệ thống',
                'email' =>':attribute không đúng định dạng',
            ],
            [

                'email' => 'Email',
                'password' => 'Mật khẩu',
            ]
        );

        $login = Auth::guard('cus')->attempt($req->only('email','password'),$req->has('remember'));

        if($login){
            return redirect()->route('clien.index');
        }else{
            return redirect()->back()->with('warning','Tên tài khoản hoặc mật khẩu chưa chính xác!');
        }
    }

    public function logout(){
        Auth::guard('cus')->logout();
        return redirect()->route('clien.login');
    }

    public function registerPage(){
        return view('clien.pages.account.register');
    }

    public function register(Request $req){
        // dd($req->all());

        $req->validate(
            [
                'name' => 'required|string|max:50',
                'address' => 'required',
                'phone' => 'required|unique:customers',
                'email' => 'required|email|unique:customers',
                'password' => 'required',
                'confirmPass' => 'required|same:password',
                
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' =>':attribute đã tồn tại trên hệ thống',
                'max' => ':attribute không được dài quá 50 ký tự',
                'email' =>':attribute không đúng định dạng',
                'same' =>':attribute không đúng',
            ],
            [
                'name' => 'Tên nhân viên',
                'address'=>'Địa chỉ',
                'phone'=>'Số điện thoại',
                'email' => 'Email',
                'password' => 'Mật khẩu',
                'confirmPass' => 'Nhập lại mật khẩu',
            ]
        );

        Customer::create([
            'name'=>$req->input('name'),
            'email'=>$req->input('email'),
            'password'=> Hash::make($req->input('password')),
            'phone'=>$req->input('phone'),
            'address'=>$req->input('address'),
        ]);

        return redirect()->route('clien.login')->with('flash','Đăng kí thành công!');
    }

    public function update(Request $req, $id){
        $req->validate(
            [
                'name' => 'required|string|max:50',
                'address' => 'required',
                'phone' => 'required|unique:customers,phone,'.$id,
                'email' => 'required|email|unique:customers,email,' .$id,
                
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' =>':attribute đã tồn tại trên hệ thống',
                'max' => ':attribute không được dài quá 50 ký tự',
                'email' =>':attribute không đúng định dạng',
            ],
            [
                'name' => 'Tên nhân viên',
                'address'=>'Địa chỉ',
                'phone'=>'Số điện thoại',
                'email' => 'Email',
            ]
        );

        if($req->input('password')==null){
            $pass = Auth::guard('cus')->user()->password;
        }else{
            $pass = Hash::make($req->input('password'));
        }

        Customer::where('id',$id)
        ->update([
            'name'=>$req->input('name'),
            'email'=>$req->input('email'),
            'password'=>$pass,
            'phone'=>$req->input('phone'),
            'address'=>$req->input('address'),
        ]);

        return redirect()->route('clien.account')->with('flash','Cập nhật thành công!');
    }

    public function index(Request $req){
        if (!Gate::allows('customer.index')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $key = '';
        if($req->input('key')){
            $key = $req->input('key');
        }
        $cus = Customer::orderBy('id','desc')->paginate(5);

        return view('admin.pages.customer.list',compact('cus'));
    }


    public function destroy($id){
        if (!Gate::allows('customer.delete')) {
            return redirect()->back()->with('warning', 'Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $cus = Customer::find($id);
        $hasOrders = $cus->orders->count();
        if($hasOrders == 0){
            $cus->delete();
            return redirect()->route('cus.index')->with('flash','Xóa khách hàng thành công');
        }else{
            return redirect()->route('cus.index')->with('warning','Không được xóa khách hàng đã có đơn hàng');
        }
        
    }
}
