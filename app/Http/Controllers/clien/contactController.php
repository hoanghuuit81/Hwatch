<?php

namespace App\Http\Controllers\clien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class contactController extends Controller
{
    public function index(){
        return view('clien.pages.contact.contact');
    }

    public function postContact(Request $req){
        $req->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'subject' => 'required',
                'content' => 'required',
            
                
            ],
            [
                'required' => ':attribute không được để trống',
                'email' =>':attribute không đúng định dạng',
            ],
            [

                'name' => 'Tên',
                'email' => 'Email',
                'phone' => 'Số điện thoại',
                'subject' => 'Tiêu đề',
                'content' => 'Nội dung',
            ]
        );

        $name = $req->input('name');
        $mail = $req->input('email');
        $phone = $req->input('phone');
        $subject = $req->input('subject');
        $content = $req->input('content');
        

        Mail::send('clien.pages.mail.mailContact', compact('name','mail','phone','subject','content'), function ($email) use($mail, $name,$subject) {
            $email->to( 'taisaokhong81@gmail.com', 'Hwatch');
            $email->subject($subject);
        });

        return redirect()->back()->with('thanks','Nội dung');
    }
}
