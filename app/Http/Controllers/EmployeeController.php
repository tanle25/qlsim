<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        # code...
        $partner = Auth::user()->partner;
        $employee = $partner->users->load(['roles','permissions']);
        // dd($employee);
        return view('dealer.employee.index',['users'=>$employee]);
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
        $request->request->add(['status'=>1,'partner_id'=>Auth::user()->partner->id]);
        $request->merge(['password'=>Hash::make($request->password)]);

        $user = User::create($request->all());
        $role = Role::findById(3);

        $user->assignRole($role);
        return back();
    }

    public function update(Request $request)
    {
        # code...

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

        if($request->has('password') && !is_null($request->password)){
            $request->merge(['password'=>Hash::make($request->password)]);
        }else{
            $request->request->remove('password');
        }

        $role = Role::findById(3);
        $user->assignRole($role);

        $user->update($request->all());


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
        $user->delete();
        return back()->with(['success'=>__('Delete successfully')]);
    }

    public function permission(Request $request)
    {
        # code...
        // dd($request->all());
        $request->validate([
            'user_id'=>'required|exists:users,id'

        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute not exists')
        ],[
            'user_id'=>__('user')
        ]);

        $user = User::find($request->user_id);
        $user->syncPermissions($request->permission);

        return back()->with(['success'=>__('Added.')]);
    }
}
