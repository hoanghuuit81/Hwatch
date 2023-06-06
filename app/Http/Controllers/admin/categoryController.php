<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        
        if(! Gate::allows('category.index')){
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
            $cate = Category::onlyTrashed()->paginate(5);
        }else{
            $key = '';
            if($req->input('key')){
                $key = $req->input('key') ;
            }
            $cate = Category::where('name','LIKE',"%{$key}%")->orderBy('id', 'desc')->paginate(5);
        }
            $count_active = Category::count();
            $count_trash = Category::onlyTrashed()->count();

            
        return view('admin.pages.category.list',compact('cate','count_active','count_trash','act'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(! Gate::allows('category.add')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $cate = Category::where('parent_id',0)->where('status',1)->get();

        return view('admin.pages.category.add',compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if(! Gate::allows('category.add')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'name' => 'required|unique:categories|max:25',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 25 ký tự',
                'unique' =>':attribute đã tồn tại trên hệ thống',
            ],
            [
                'name' => 'Tên danh mục',
            ]
        );

        Category::create([
            'name'=>$req->input('name'),
            'status'=>$req->input('status'),
            'parent_id'=>$req->input('parent_id')
        ]);

        return redirect()->route('category.index')->with('flash','Thêm mới danh mục thành công');
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
        if(! Gate::allows('category.edit')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $parentCate = Category::where('parent_id',0)->where('status',1)->get();
        $cate = Category::find($id);
        return view('admin.pages.category.edit',compact('cate','parentCate'));
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
        if(! Gate::allows('category.edit')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'name' => 'required|max:25|unique:categories,name,'.$id,
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 25 ký tự',
                'unique' =>':attribute đã tồn tại trên hệ thống',
            ],
            [
                'name' => 'Tên danh mục',
            ]
        );

        //không cho ẩn danh mục cha đã có danh mục con
        $cate = Category::find($id);
        $hasChildren = $cate->children;
        if($hasChildren->count() > 0  && $req->input('status')==0){
            return redirect()->back()->with('warning','Không được ẩn danh mục vì đã có danh mục con!');
        }

        //không cho ẩn danh mục đã có sản phẩm
        $hasPro  = $cate->products;
        if($hasPro->count() > 0  && $req->input('status')==0){
            return redirect()->back()->with('warning','Không được ẩn danh mục này vì đang có sản phẩm thuộc danh mục!');
        }
        
        Category::where('id',$id)
            ->update([
            'name'=>$req->input('name'),
            'status'=>$req->input('status'),
            'parent_id'=>$req->input('parent_id'),
        ]);
        
        return redirect()->route('category.index')->with('flash','Cập nhật danh mục thành công');
    }


    public function action(Request $req){
        $list_check = $req->input('list_check');
             
        if(!empty($list_check)){
           
            $act = $req->input('act');
            if($act == 'delete'){
                if(! Gate::allows('category.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Category::destroy($list_check);
                return redirect()->route('category.index')->with('flash','Xóa thành công');
            }

            if($act == 'restore'){
                if(! Gate::allows('category.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Category::withTrashed()
                ->whereIn('id',$list_check)
                ->restore();
                return redirect()->route('category.index')->with('flash','Khôi phục thành công');
            }

            if($act == 'forceDelete'){
                if(! Gate::allows('category.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Category::withTrashed()
                ->whereIn('id',$list_check)
                ->forceDelete();
                return redirect()->route('category.index')->with('flash','Xóa vĩnh viễn thành công');
            }

        }else{
            return redirect()->route('category.index')->with('flash','Bạn cần chọn mục thể thực hiện hành động');
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
        if(! Gate::allows('category.delete')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $cate = Category::find($id);
        $cate->delete();
        return redirect()->route('category.index')->with('flash','Xóa thành công');
    }
}
