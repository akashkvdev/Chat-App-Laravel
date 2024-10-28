<?php

namespace App\Http\Controllers;

use App\Events\chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //

    public function index(){
        return view('welcome');
    }
    public function notFound(){
        // return abort(404,'Not Found');
        return view('notFound');
    }
    public function chat(Request $request){
        $request->validate([
            'username' => 'required',
        ]);
        $username=$request->username;
        return view('chat')->with(['name'=>$username]);

    }

    public function broadCastChat(Request $request){
        $request->validate([
            'username'=>'required',
            'message'=>'required',
        ]);
        event(new chat($request->username,$request->message));
        return response()->json($request->all());
    }
}
