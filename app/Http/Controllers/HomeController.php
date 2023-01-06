<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\SimCard;
use Carbon\Carbon;
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

    public function history()
    {
        # code...
        $histories = History::orderBy('created_at','desc')->get();
        return view('admin.pages.lich-su-thay-doi',['histories'=>$histories]);
    }

    public function trash()
    {
        # code...
        $sims = SimCard::onlyTrashed()->get();
        return view('admin.pages.thung-rac',['sims'=>$sims]);
    }

    public function restore($sim)
    {
        # code...
        $simCard= SimCard::withTrashed()->where('id',$sim)->firstOrFail();
        $simCard->restore();
        return back();
    }

    public function delete($sim)
    {
        # code...
        $simCard= SimCard::withTrashed()->where('id',$sim)->firstOrFail();
        $simCard->forceDelete();
        return back();
    }

    public function expiredContract()
    {
        # code...
        $sims = SimCard::whereBetween('partner.expired',[Carbon::today()->subDays(5), Carbon::today()])->get();
        dd($sims);
    }
}
