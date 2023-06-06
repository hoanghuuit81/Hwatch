<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\Permission;
use App\Role_Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if(! Gate::allows('role.index')){
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
            $role = Role::onlyTrashed()->paginate(5);
        }else{
            $key = '';
            if($req->input('key')){
                $key = $req->input('key') ;
            }
            $role = Role::where('name','LIKE',"%{$key}%")->orderBy('id', 'desc')->paginate(5);
        }
            $count_active = Role::count();
            $count_trash = Role::onlyTrashed()->count();

        return view('admin.pages.role.list',compact('role','act','count_active','count_trash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(! Gate::allows('role.add')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $per = Permission::all()->groupBy( function($per){
                
            return explode('.', $per->slug) [0];
        }); 

        return view('admin.pages.role.add',compact('per'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if(! Gate::allows('role.add')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'name' => 'required|unique:roles|max:20',
                'description' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 20 ký tự',
                'unique' =>':attribute đã tồn tại trên hệ thống',
            ],
            [
                'name' => 'Tên quyền',
                'description' => 'Mô tả',
            ]
        );

        $role = Role::create([
            'name'=>$req->input('name'),
            'description'=>$req->input('description'),
        ]);

        $role->permissions()->attach($req->input('permission_id'));
        return redirect()->route('role.index')->with('flash','Thêm mới quyền thành công');
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
        if(! Gate::allows('role.edit')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $checked=[];
        $per = Permission::all()->groupBy( function($per){
                
            return explode('.', $per->slug) [0];
        });
        $role = Role::find($id);
        $check = Role_Permission::where('role_id',$id)->get();
        foreach ($check as $value) {
            array_push($checked,$value->permission_id);
         }
        return view('admin.pages.role.edit',compact('role','per','checked'));
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
        if(! Gate::allows('role.edit')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'name' => 'required|max:20|unique:roles,name,'.$id,
                'description' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 20 ký tự',
                'unique' =>':attribute đã tồn tại trên hệ thống',
            ],
            [
                'name' => 'Tên quyền',
                'description' => 'Mô tả',
            ]
        );
        

        Role::where('id',$id)
            ->update([
            'name'=>$req->input('name'),
            'description'=>$req->input('description'),
        ]);
        $role = Role::find($id);

        $role->permissions()->sync($req->input('permission_id', []));

        return redirect()->route('role.index')->with('flash','Cập nhật quyền thành công');

    }

    public function action(Request $req){
        $list_check = $req->input('list_check');
             
        if(!empty($list_check)){
           
            $act = $req->input('act');
            if($act == 'delete'){
                if(! Gate::allows('role.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Role::destroy($list_check);
                return redirect()->route('role.index')->with('flash','Xóa thành công');
            }

            if($act == 'restore'){
                if(! Gate::allows('role.add')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Role::withTrashed()
                ->whereIn('id',$list_check)
                ->restore();
                return redirect()->route('role.index')->with('flash','Khôi phục thành công');
            }

            if($act == 'forceDelete'){
                if(! Gate::allows('role.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                Role::withTrashed()
                ->whereIn('id',$list_check)
                ->forceDelete();
                return redirect()->route('role.index')->with('flash','Xóa vĩnh viễn thành công');
            }
            
        }else{
            return redirect()->route('role.index')->with('flash','Bạn cần chọn mục thể thực hiện hành động');
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
        if(! Gate::allows('role.delete')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $role = Permission::find($id);
        $role->delete();
        return redirect()->route('role.index')->with('flash','Xóa thành công');
    }
}
