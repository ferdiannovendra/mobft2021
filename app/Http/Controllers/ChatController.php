<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // count how many message are unread from the selected user
        // $user_status = DB::select("select status from users where status =35")->dump();
        $user_status = DB::table('users')
        ->select('status')
        ->where('nrp', '=', Auth::user()->nrp)
        // ->where('status', '=', 'panitia')
        ->get();
        $stat ="";
        $users = DB::select("select users.nrp, users.name, users.avatar, users.email, count(is_read) as unread
            from users LEFT  JOIN  messages ON users.nrp = messages.from and is_read = 0 and messages.to = " . Auth::user()->nrp . "
            where users.nrp != " . Auth::user()->nrp . "
            group by users.nrp, users.name, users.avatar, users.email");
        $panitia = DB::select("select users.nrp, users.name, users.avatar, users.email, count(is_read) as unread
            from users LEFT  JOIN  messages ON users.nrp = messages.from and is_read = 0 and messages.to = " . Auth::user()->nrp . "
            where users.nrp != " . Auth::user()->nrp . " and status = 'panitia'
            group by users.nrp, users.name, users.avatar, users.email");

        return view('ask', ['users' => $users, 'status' => $user_status, 'panitia' => $panitia]);

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

    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        // Make read all unread message
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);

        // Get all message from selected user
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->get();

        return view('messages.index', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
