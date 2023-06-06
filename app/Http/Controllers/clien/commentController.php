<?php

namespace App\Http\Controllers\clien;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class commentController extends Controller
{
    public function postComment(Request $req, $id){

        // dd($req->all());
        Comment::create([
            'name'=>$req->input('name'),
            'product_id'=> $id,
            'email'=>$req->input('email'),
            'content'=>$req->input('content'),
            'status'=> 1,
        ]);

        return redirect()->route('clien.productDetail',$id);
    }

    public function index(){
        $comments = Comment::orderBy('id','DESC')->paginate(5);
        return view('admin.pages.comment.list',compact('comments'));
    }

    public function edit($id){
        $comment = Comment::find($id);
        return view('admin.pages.comment.edit',compact('comment'));
    }

    public function update(Request $req,$id){
        $cmt = Comment::find($id);

        $product_id = $cmt->product->id;

        Comment::where('id',$id)
            ->update([
            'name'=>$req->input('name'),
            'product_id'=>  $product_id,
            'email'=>$req->input('email'),
            'content'=>$cmt->content,
            'status' => $req->input('status'),
        ]);

        return redirect()->route('cmt.index')->with('flash','Cập nhật thành công');
    }
}
