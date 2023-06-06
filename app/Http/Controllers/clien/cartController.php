<?php

namespace App\Http\Controllers\clien;

use App\Http\Controllers\Controller;
use App\Mail\orderMail;
use App\Order;
use App\OrderDetail;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class cartController extends Controller
{
    public function index(){
        return view('clien.pages.cart.cart');
    }

    public function add(Request $req, $id)
    {
        $pro = Products::find($id);
        if($req->has('quantity')){
            $qty = $req->quantity;
        }else{
            $qty = 1;
        }

        
        Cart::add([
            'id' => $pro->id,
            'name' => $pro->name,
            'qty' => $qty,
            'price' => $pro->sale_price,
            'options' => ['image' => $pro->image]
        ]);

        return redirect()->back()->with('addCart','Thêm vào giỏ hàng thành công');
    }

    public function delete($id){
        
        Cart::remove($id);

        return redirect()->back();
    }

    public function update(Request $req){
        $data = $req->input('qty');
        foreach($data as $k=>$v){
            Cart::update($k,$v);
        }
        return redirect()->back();
    }

    public function destroy(){
        Cart::destroy();
        return redirect()->back();
    }

    public function form_checkout(){
        return view('clien.pages.cart.check-out');
    }

    public function generateOrderCode(){
    $prefix = 'HHH'; 
    $length = 8; 

    $randomString = Str::random($length);
    $orderCode = $prefix . '-' . $randomString; 
    return $orderCode;
    }

    public function postCheckOut(Request $req){
        $code_order = $this->generateOrderCode();
        $customer_id = Auth::guard('cus')->user()->id;

        $auth =  Auth::guard('cus')->user();
        

        $total_amount = Cart::subtotal();
        $total_amount = str_replace(',', '', $total_amount);
        $total_amount = str_replace('$', '', $total_amount); 
        $total_amount = (float) $total_amount;     
        $total_amount = number_format($total_amount, 0, '', '');

        $order = Order::create([
            'code_order'=>$code_order,
            'customer_id'=> $customer_id,
            'total_amount'=> $total_amount ,
            'address' => $req->input('address'),
            'phone' => $req->input('phone'),
            'notes' => $req->input('notes'),
            'status' => 0,
        ]);


        foreach(Cart::content() as $item){
            OrderDetail::create([
                'order_id'=> $order->id,
                'product_id' => $item->id,
                'quantity'	=> $item->qty,
                'price'	=> $item->price,
                'subtotal' => $item->qty*$item->price,
            ]);
        }
        
        Mail::send('clien.pages.mail.mailOrder', compact('order','auth'), function ($email) use($auth) {
            $email->to($auth->email, $auth->name);
            $email->subject('[HHwatch] Thư xác nhận đơn hàng thành công! ');
        });

        Mail::send('clien.pages.mail.mailOrder', compact('order','auth'), function ($email) use($auth) {
            $email->to('taisaokhong81@gmail.com', 'Hoang Hai Huu');
            $email->subject('[HHwatch] Thông báo đơn hàng mới! ');
        });

        Cart::destroy();
        return view('clien.pages.cart.thanks');
    }
}
