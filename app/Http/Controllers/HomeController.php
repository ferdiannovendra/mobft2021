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
        return view('home',["data"=>$alldata]);
    }
    public function setpassword()
    {
        $nrp = Hash::make(Auth::user()->nrp);
        $alldata = User::All();
        foreach ($alldata as $key) {

            $hashed = Hash::make($key->nrp);
            $affected = DB::table('users')
              ->where('nrp', $key->nrp)
              ->update(['password' => $hashed]);
        }

        if ($affected) {
            echo "sukses";
        }else{
            echo "gagal";

        }
        // return view('home')->with('status','Oke');
    }
}
