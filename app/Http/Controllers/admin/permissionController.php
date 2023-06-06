<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class permissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if(! Gate::allows('permission.index')){
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
            $per = Permission::onlyTrashed()->paginate(5);
            $count_active = Permission::count();
            $count_trash = Permission::onlyTrashed()->count();
            return view('admin.pages.permission.listTrash',compact('per','count_trash','count_active','act'));
            
        }else{
           
            $per = Permission::all()->groupBy( function($per){
                
                return explode('.', $per->slug) [0];
            }); 
            
        }
            $count_active = Permission::count();
            $count_trash = Permission::onlyTrashed()->count();

        return view('admin.pages.permission.list',compact('per','count_active','count_trash','act'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(! Gate::allows('permission.add')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        return view('admin.pages.permission.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if(! Gate::allows('permission.add')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'name' => 'required|max:30|unique:permissions',
                'slug' => 'required|regex:/^[a-zA-Z]+(\.[a-zA-Z]+)$/|unique:permissions',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 20 ký tự',
                'unique' => ':attribute đã tồn tại trên hệ thống',
                'regex' => ':attribute phải đúng định dạng vd:user.add',
            ],
            [
                'name' => 'Tên vai trò',
                'slug' => 'Slug',
            ]
        );

        Permission::create([
            'name'=>$req->input('name'),
            'slug'=>$req->input('slug'),
            'description'=>$req->input('description'),
        ]);
        return redirect()->route('permission.index')->with('flash','Thêm mới vai trò thành công');
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
        if(! Gate::allows('permission.edit')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $per = Permission::find($id);

        return view('admin.pages.permission.edit',compact('per'));
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
        if(! Gate::allows('permission.edit')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'name' => 'required|max:30|unique:permissions,name,'.$id,
                'slug' => 'required|regex:/^[a-zA-Z]+(\.[a-zA-Z]+)$/|unique:permissions,slug,'.$id,
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 20 ký tự',
                'unique' => ':attribute đã tồn tại trên hệ thống',
                'regex' => ':attribute phải đúng định dạng vd:user.add',
            ],
            [
                'name' => 'Tên vai trò',
                'slug' => 'Slug',
            ]
        );

        Permission::where('id',$id)
        ->update([
            'name'=>$req->input('name'),
            'slug'=>$req->input('slug'),
            'description'=>$req->input('description'),
        ]);
        return redirect()->route('permission.index')->with('flash','Cập nhật vai trò thành công');
    }

    public function action(Request $req){
        $list_check = $req->input('list_check');
             
        if(!empty($list_check)){
           
            $act = $req->input('act');
            if($act == 'delete'){
                if(! Gate::allows('permission.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Permission::destroy($list_check);
                return redirect()->route('permission.index')->with('flash','Xóa thành công');
            }

            if($act == 'restore'){
                if(! Gate::allows('permission.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Permission::withTrashed()
                ->whereIn('id',$list_check)
                ->restore();
                return redirect()->route('permission.index')->with('flash','Khôi phục thành công');
            }

            if($act == 'forceDelete'){
                if(! Gate::allows('permission.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Permission::withTrashed()
                ->whereIn('id',$list_check)
                ->forceDelete();
                return redirect()->route('permission.index')->with('flash','Xóa vĩnh viễn thành công');
            }
            
        }else{
            return redirect()->route('permission.index')->with('flash','Bạn cần chọn mục thể thực hiện hành động');
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
        if(! Gate::allows('permission.delete')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $per = Permission::find($id);
            $per->delete();

            return redirect()->route('permission.index')->with('flash','Xóa thành công');
    }
}
