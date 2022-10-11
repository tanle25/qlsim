<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{


    public function index()
    {
        return view('home');
    }

    public function toggleDarkMode()
    {
        # code...
        if(Session::has('darkMode')){
            Session::forget('darkMode');
        }else{
            Session::put('darkMode',true);
        }
    }

    public function changeLang($lang)
    {
        # code...
        if($lang != 'vi' && $lang !='jp'){
            return back();
        }

        App::setLocale($lang);
        session()->put('locale',$lang);
        return redirect()->back();
    }
}
