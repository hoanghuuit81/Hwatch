<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use App\User;
use App\User_Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if(! Gate::allows('user.index')){
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
            $user = User::onlyTrashed()->paginate(1);
        }else{
            $key = '';
            if($req->input('key')){
                $key = $req->input('key') ;
            }
            $user = User::where('name','LIKE',"%{$key}%")->orderBy('id', 'desc')->paginate(2);
        }
            $count_active = User::count();
            $count_trash = User::onlyTrashed()->count();

        return view('admin.pages.users.list',compact('user','count_active','count_trash','act'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(! Gate::allows('user.add')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $role = Role::all();

        return view('admin.pages.users.add',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if(! Gate::allows('user.add')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->all();
        $req->validate(
            [
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'avartar'=>'required',
                'sex' => 'required',
                'address' => 'required',
                'birthday' => 'required|before:now',
                'salary' => 'required',
                'position' => 'required',
                'dateJoinCompany' => 'required|before:now',
                'role' => 'required',
                
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' =>':attribute đã tồn tại trên hệ thống',
                'max' => ':attribute không được dài quá 50 ký tự',
                'before' =>':attribute phải nhỏ hơn ngày hiện tại',
                'email' =>':attribute không đúng định dạng',
            ],
            [
                'name' => 'Tên nhân viên',
                'email' => 'Email',
                'password' => 'Mật khẩu',
                'avartar' => 'Ảnh đại diện',
                'sex' => 'Giới tính',
                'address'=>'Địa chỉ',
                'birthday'=>'Sinh nhật',
                'salary'=>'Lương',
                'position'=>'Vị trí',
                'dateJoinCompany'=>'Ngày vào công ty',
                'role'=>'Quyền truy cập',
            ]
        );

        

        if ($req->has('avartar')) {
            $file = $req->avartar;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }

        $req->merge(['file_name' => $file_name]);

        $user = User::create([
            'name'=>$req->input('name'),
            'email'=>$req->input('email'),
            'password'=> Hash::make($req->input('password')),
            'avartar'=>$file_name,
            'sex'=>$req->input('sex'),
            'birthday'=>$req->input('birthday'),
            'address'=>$req->input('address'),
            'salary'=>$req->input('salary'),
            'position'=>$req->input('position'),
            'dateJoinCompany'=>$req->input('dateJoinCompany'),
        ]);

        $user->roles()->attach($req->input('role'));
        return redirect()->route('user.index')->with('flash','Thêm mới nhân viên thành công');
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
        if(! Gate::allows('user.edit')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $user = User::find($id);
        $role = Role::all();
        $role_old = User_Role::where('user_id',$id)->get();
        $role_old_id = $role_old->first()->role_id;
    
        return view('admin.pages.users.edit',compact('user','role','role_old_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id, User $user)
    {
        if(! Gate::allows('user.edit')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        $req->validate(
            [
                'name' => 'required|string|max:50',
                'email' => 'required|email|unique:users,email,'.$id,
                'password' => 'required',
                'sex' => 'required',
                'address' => 'required',
                'birthday' => 'required|before:now',
                'salary' => 'required',
                'position' => 'required',
                'dateJoinCompany' => 'required|before:now',
                
                
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute không được dài quá 50 ký tự',
                'unique' =>':attribute đã tồn tại trên hệ thống',
                'before' =>':attribute phải nhỏ hơn ngày hiện tại',
                'email' =>':attribute không đúng định dạng',
            ],
            [
                'name' => 'Tên nhân viên',
                'email' => 'Email',
                'password' => 'Mật khẩu',
                'sex' => 'Giới tính',
                'address'=>'Địa chỉ',
                'birthday'=>'Sinh nhật',
                'salary'=>'Lương',
                'position'=>'Vị trí',
                'dateJoinCompany'=>'Ngày vào công ty',
                
            ]
        );

        $employeeUpdate = User::find($id);

        if (!$req->has('avartar')) {
            $file_name = $employeeUpdate->avartar;
        }else{
             // Xóa file cũ
             $isExists = File::exists(public_path('files/' . $employeeUpdate->file));

             if ($isExists) {
                 File::delete(public_path('files/' . $employeeUpdate->file));
             }
 
             $file = $req->avartar;
             $file_name = $file->getClientOriginalName();
             $file->move(public_path('uploads'), $file_name);
             $req->merge(['file_name' => $file_name]);
        }

        $fileUpload = $file_name;

        User::where('id',$id)
            ->update([
            'name'=>$req->input('name'),
            'email'=>$req->input('email'),
            'password'=> $req->input('password'),
            'avartar'=>$fileUpload,
            'sex'=>$req->input('sex'),
            'birthday'=>$req->input('birthday'),
            'address'=>$req->input('address'),
            'salary'=>$req->input('salary'),
            'position'=>$req->input('position'),
            'dateJoinCompany'=>$req->input('dateJoinCompany'),
        ]);

        

        $employeeUpdate->roles()->sync($req->input('role'));
        return redirect()->route('user.index')->with('flash','Cập nhật nhân viên thành công');
    }

    public function action(Request $req){
        $list_check = $req->input('list_check');
        
        if(!empty($list_check)){
            foreach($list_check as $k=>$v){
                if(Auth::id()==$v){
                    unset($list_check[$k]);
                    return redirect()->route('user.index')->with('flash','Bạn không thể xóa chính bạn');
                }
            }
        }
       
        if(!empty($list_check)){
           
            $act = $req->input('act');
            if($act == 'delete'){
                if(! Gate::allows('user.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                User::destroy($list_check);
                return redirect()->route('user.index')->with('flash','Xóa thành công');
            }

            if($act == 'restore'){
                if(! Gate::allows('user.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                User::withTrashed()
                ->whereIn('id',$list_check)
                ->restore();
                return redirect()->route('user.index')->with('flash','Khôi phục thành công');
            }

            if($act == 'forceDelete'){
                if(! Gate::allows('user.delete')){
                    return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
                }
                User::withTrashed()
                ->whereIn('id',$list_check)
                ->forceDelete();
                return redirect()->route('user.index')->with('flash','Xóa vĩnh viễn thành công');
            }
            
        }else{
            return redirect()->route('user.index')->with('flash','Bạn cần chọn mục thể thực hiện hành động');
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
        if(! Gate::allows('user.delete')){
            return redirect()->back()->with('warning','Bạn không đủ thẩm quyền để làm hành động này!');
        }
        if(Auth::id()!= $id){
            $user = User::find($id);
            $user->delete();

            return redirect()->route('user.index')->with('flash','Xóa thành công');
        }else{
            return redirect()->route('user.index')->with('flash','Bạn không thể xóa chính mình');
        }
    }
}
