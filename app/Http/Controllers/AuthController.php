<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\User;
use Carbon\Carbon;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //

    public function showLoginForm()
    {
        # code...
        return view('login.login');
    }

    public function showRegisterForm()
    {
        # code...
        return view('login.register');
    }
    public function login(Request $request)
    {
        # code...
        // dd($request);
        $request->validate([
            'email'=>'required|email:rfc,dns',
            'password'=>'required'
        ],[
            'email'=>__(':attribute invalid'),
            'required'=>__(':attribute required')
        ],[
           'email'=>'Email',
           'password'=>'Password'
        ]);
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember') ? true : false;
        if (Auth::attempt($credentials,$remember)) {
            // dd(Auth::user());
            if(Auth::user()->hasRole('admin')){
                return redirect()->route('admin');

            }else{
                return redirect()->route('dealer');
            }
        }
        return redirect()->back()->withErrors(['loginfail'=>'login fail']);
    }

    public function logout(Request $request)
    {
        # code...
        // dd($request);
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect(url('login'));
    }

    public function register(Request $request)
    {
        # code...
        // dd($request->all());

        $request->validate([
            'name'=>'required',
            'email'=>'required|email:rfc,dns|unique:users,email',
            'phone'=>'required|unique:users,phone',
            'password'=>'required|min:8|confirmed'
        ],[
            'required'=>__(':attribute required'),
            'email'=>__(':attribute invalid'),
            'unique'=>__(':attribute exists'),
            'min'=>__('The :attribute must be at least 8 characters.'),
            'confirmed'=>__('Does not match password confirmation')
        ],[
            'name'=>__('Full name'),
            'email'=>__('Email Address'),
            'phone'=>__('phone'),
            'password'=>__('Password'),
            'password_confirmation'=>__('Confirm Password')
        ]);
        $request->request->add(['status'=>0]);
        $request->merge(['password'=>Hash::make($request->password)]);
        $user = User::create($request->all());
        Mail::to($user->email)->send(new VerifyEmail($user));
        // dd('passed');
        Session::put('verifyUser',$user);
        return redirect(url('verify-user'));
        // return view('login.otp',['url'=>url('register-verify')]);
    }

    public function verify(Request $request)
    {
        # code...
        $request->validate([
            'otp'=>'required|array',
            'otp.*'=>'required|digits:1',
            'user_id'=>'required|exists:users,id'
        ],[
            'required'=>__(':attribute required'),
            'digits'=>__(':attribute invalid'),
            'exists'=>__(':attribute not exists')
        ],[
            'otp'=>'OTP'
        ]);
        $input = implode('',$request->otp);
        $token = new Otp;
        $user = User::find($request->user_id);

        $otp = $token->validate($user->email, $input);
        if($otp->status){
            $user->markEmailAsVerified();
            return redirect()->to(url('login'))->with(['success'=>__('Success')]);
        }else{
            return redirect()->back()->withErrors(['fail'=>__($otp->message)]);
        }
    }

    public function verifyOtp(Request $request)
    {
        # code...
        $request->validate([
            'otp'=>'required|array',
            'otp.*'=>'required|digits:1',
            'user_id'=>'required|exists:users,id'
        ],[
            'required'=>__(':attribute required'),
            'digits'=>__(':attribute invalid'),
            'exists'=>__(':attribute not exists')
        ],[
            'otp'=>'OTP'
        ]);
        $input = implode('',$request->otp);
        $token = new Otp;
        $user = User::find($request->user_id);

        $otp = $token->validate($user->email, $input);
        if($otp->status){
            // $user->markEmailAsVerified();
            return redirect()->to(url('reset-password'));
        }else{
            return redirect()->back()->withErrors(['fail'=>__($otp->message)]);
        }
    }

    public function forgotPassword(Request $request)
    {
        # code...

        $request->validate([
            'email'=>'required|email:rfc,dns|exists:users,email'
        ],[
            'required'=>__(':attribute required'),
            'exists'=>__(':attribute not exists')
        ],[
            'email'=>__('Email Address')
        ]);
        $user = User::whereEmail($request->email)->first();
        Session::put('verifyUser',$user);
        Mail::to($user->email)->send(new VerifyEmail($user));
        return redirect(url('verify-otp'));
    }
    public function changePassword(Request $request)
    {
        # code...
        $request->validate([
            'password'=>'required|min:8|confirmed'
        ],[
            'required'=>__(':attribute required'),
            'min'=>__('The :attribute must be at least 8 characters.'),
            'confirmed'=>__('Does not match password confirmation')
        ],[
            'password'=>__('Password')
        ]);
        $user = Session::get('verifyUser');
        $user->update([
            'password'=>Hash::make($request->password)
        ]);
        return redirect(url('login'))->with(['success'=>__('Update success')]);
    }
}
