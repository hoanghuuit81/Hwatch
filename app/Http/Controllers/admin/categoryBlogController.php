<?php

namespace App\Http\Controllers\admin;

use App\Category_blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class categoryBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if(! Gate::allows('cateBlog.index')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        
        $act = [
            'delete'=>'Xóa tạm thời'
        ];
        if($req->input('status')=='trash'){
            $act = [
                'forceDelete'=>'Xóa vĩnh viễn',
                'restore'=>'khôi phục'
            ];
            $cate = Category_blog::onlyTrashed()->paginate(5);
        }else{
            $key = '';
            if($req->input('key')){
                $key = $req->input('key') ;
            }
            $cate = Category_blog::where('name','LIKE',"%{$key}%")->orderBy('id', 'desc')->paginate(5);
        }
            $count_active = Category_blog::count();
            $count_trash = Category_blog::onlyTrashed()->count();

            
        return view('admin.pages.categoryBlog.list',compact('cate','count_active','count_trash','act'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(! Gate::allows('cateBlog.add')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }

        return view('admin.pages.categoryBlog.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if(! Gate::allows('cateBlog.add')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'name' => 'required|unique:category_blogs|max:25',
                'status' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 25 ký tự',
                'unique' =>':attribute đã tồn tại trên hệ thống',
            ],
            [
                'name' => 'Tên danh mục',
                'status' => 'Trạng thái',
            ]
        );

        Category_blog::create([
            'name'=>$req->input('name'),
            'status'=>$req->input('status'),
        ]);

        return redirect()->route('cateBlog.index')->with('flash','Thêm mới danh mục thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(! Gate::allows('cateBlog.edit')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $cate = Category_blog::find($id);
        return view('admin.pages.categoryBlog.edit',compact('cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        if(! Gate::allows('cateBlog.edit')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'name' => 'required|max:25|unique:category_blogs,name,'.$id,
                'status' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 25 ký tự',
                'unique' =>':attribute đã tồn tại trên hệ thống',
            ],
            [
                'name' => 'Tên danh mục',
                'status' => 'Trạng thái',
            ]
        );


        $cate_blog = Category_blog::find($id);
        $hasBlog = $cate_blog->blogs;
        if($hasBlog->count() > 0  && $req->input('status')==0){
            return redirect()->back()->with('warning','Không được ẩn danh mục vì đã có bài viết thuộc danh mục này!');
        }
        

        Category_blog::where('id',$id)
            ->update([
            'name'=>$req->input('name'),
            'status'=>$req->input('status'),
        ]);
        
        return redirect()->route('cateBlog.index')->with('flash','Cập nhật danh mục thành công');
    }

    public function action(Request $req){
        $list_check = $req->input('list_check');
             
        if(!empty($list_check)){
           
            $act = $req->input('act');
            if($act == 'delete'){
                if(! Gate::allows('cateBlog.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Category_blog::destroy($list_check);
                return redirect()->route('cateBlog.index')->with('flash','Xóa thành công');
            }

            if($act == 'restore'){
                if(! Gate::allows('cateBlog.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Category_blog::withTrashed()
                ->whereIn('id',$list_check)
                ->restore();
                return redirect()->route('cateBlog.index')->with('flash','Khôi phục thành công');
            }

            if($act == 'forceDelete'){
                if(! Gate::allows('cateBlog.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Category_blog::withTrashed()
                ->whereIn('id',$list_check)
                ->forceDelete();
                return redirect()->route('cateBlog.index')->with('flash','Xóa vĩnh viễn thành công');
            }

        }else{
            return redirect()->route('cateBlog.index')->with('flash','Bạn cần chọn mục thể thực hiện hành động');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(! Gate::allows('cateBlog.delete')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $cate = Category_blog::find($id);
        $cate->delete();
        return redirect()->route('cateBlog.index')->with('flash','Xóa thành công');
    }
}
