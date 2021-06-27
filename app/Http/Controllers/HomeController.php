<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $alldata = DB::table('users')->where('nrp',Auth::user()->nrp)->get();
        // echo $alldata;
        $reset = DB::table('users')->select('is_reset')->where('nrp', Auth::user()->nrp)->get();
        // echo $reset[0]->is_reset;
        if($reset[0]->is_reset == 0){
            return view('resetpassword');
        }else{
            return view('home',["data"=>$alldata]);
        }
        // return view('home',["data"=>$alldata]);
        // return view('home',["data"=>$alldata]);
    }

}
