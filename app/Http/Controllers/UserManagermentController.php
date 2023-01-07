<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserManagermentController extends Controller
{
    //
    public function index()
    {
        # code...
        $users = User::all();
        $roles = Role::all();
        return view('admin.pages.user.index',['users'=>$users,'roles'=>$roles]);
    }

    public function store(Request $request)
    {
        # code...
        // dd($request->all());
        $request->validate([

            'name'=>'required',
            'email'=>'required|email:rfc,dns|unique:users,email',
            'password'=>'required',
            'phone'=>'required|unique:users,phone',

        ],[
            'required'=>__(':attribute required'),
            'email'=>__(':attribute invalid')
        ],[
            'name'=>__('Full name'),
            'email'=>__('Email'),
            'password'=>__('Password'),
            'phone'=>__('phone')
        ]);
        $request->request->add(['status'=>1]);
        $request->merge(['password'=>Hash::make($request->password)]);

        $user = User::create($request->all());

        if($request->has('role')){
            $role = Role::findById($request->role);

            $user->assignRole($role);
        }
        return back();
    }

    public function update(Request $request)
    {
        # code...

        // dd($request->all());
        $user = User::find($request->user_id);
        if($user == null){
            return redirect()->back()->withErrors(['errors'=>__('User not found')]);
        }

        $request->validate([
            'name'=>'required',
            'password'=>['nullable',
                Password::min(8)
                ->letters()
                ->mixedCase()
                ->symbols()
                ->uncompromised()
            ],
            'email'=>'required|email:rfc,dns|unique:users,email,'.$user->id,
            'phone'=>'required|unique:users,phone,'.$user->id,

        ],[
            'required'=>__(':attribute required'),
            'email'=>__(':attribute invalid'),
            'min'=>__('The :attribute must be at least 8 characters.')
        ],[
            'name'=>__('Full name'),
            'email'=>__('Email'),
            'phone'=>__('phone'),
            'password'=>__('Password'),
        ]);

        if( !$request->has('status')){
            $request->request->add(['status'=>0]);
        }

        if($request->has('password') && !is_null($request->password)){
            $request->merge(['password'=>Hash::make($request->password)]);
        }else{
            $request->request->remove('password');
        }

        $user->update($request->all());

        $user->syncRoles([]);

        if($request->has('role') && !is_null($request->role)){
            $role = Role::findById($request->role);
            $user->assignRole($role);
        }

        return back()->with(['success'=>__('Update success')]);

    }

    public function delete(Request $request)
    {
        # code...

        $request->validate([
            'user_id'=>'required|exists:users,id'
        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute exists')
        ],[
            'user_id'=>__('user')
        ]);



        $user = User::find($request->user_id);

        if($user->hasRole('admin')){
            return back()->withErrors(['fail'=>'Bạn không thể xoá tài khoản này']);
        }
        $user->invoices()->delete();
        $user->delete();
        return back()->with(['success'=>__('Delete successfully')]);
    }
}
