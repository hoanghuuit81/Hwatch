<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class orderController extends Controller
{
    public function index(Request $req){

        if ($req->input('status') == 'all') {
            $orders = Order::orderBy('id','DESC')->paginate(5);
        }elseif($req->input('status') == '0'){
            $orders = Order::where('status',0)->orderBy('id','DESC')->paginate(5);
        }elseif($req->input('status') == '1'){
            $orders = Order::where('status',1)->orderBy('id','DESC')->paginate(5);
        }elseif($req->input('status') == '2'){
            $orders = Order::where('status',2)->orderBy('id','DESC')->paginate(5);      
        }elseif($req->input('status') == '3'){
            $orders = Order::where('status',3)->orderBy('id','DESC')->paginate(5);
        }else{
            $key = '';
            if($req->has('key')){
                $key = $req->input('key');
            }   
            $orders = Order::where('code_order','LIKE',"%{$key}%")->orderBy('id','DESC')->paginate(5);
        }
        $countAll = Order::count();
        $count0 = Order::where('status',0)->count();
        $count1 = Order::where('status',1)->count();
        $count2 = Order::where('status',2)->count();
        $count3 = Order::where('status',3)->count();
       
        return view('admin.pages.order.list',compact('orders','countAll','count0','count1','count2','count3'));
    }


    public function edit($id){
        $order = Order::find($id);

        return view('admin.pages.order.edit',compact('order'));
    }

    public function update(Request $req, $id){
        $status = $req->input('status');
        Order::where('id',$id)
        ->update([
            'status'=>$status,
        ]);

        return redirect()->route('order.index')->with('flash','Cập nhật trạng thái đơn hàng thành công');
    }

    public function destroy($id){
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('order.index')->with('flash','Xóa đơn hàng thành công');
    }

    public function printPdf($id){
        $order = Order::find($id);
       
 
        $pdf = Pdf::loadView('admin.pages.pdf.detail',compact('order'));

        return $pdf->stream();

    }


}
