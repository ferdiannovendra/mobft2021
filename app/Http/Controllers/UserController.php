<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setpassword()
    {
        // $nrp = Hash::make(Auth::user()->nrp);
        $alldata = User::All();
        foreach ($alldata as $key) {

            $hashed = Hash::make('12345');
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

    public function resetpassword(Request $request)
    {
        $curr_nrp = Auth::user()->nrp;
        $postPassword = $request->get('password');
        $hashPassword = Hash::make($postPassword);

        $affected = DB::table('users')
              ->where('nrp', $curr_nrp)
              ->update(['password' => $hashPassword,
              'is_reset' => 1
              ]);

        return redirect()->route('home')->with('status','Password berhasil diubah');
    }
}
