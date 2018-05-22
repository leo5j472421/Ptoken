<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Transaction;
use Carbon\Carbon as Carbon;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }

    public function state()
    {
        $user = Auth::user();
        $userid = $user->id;
        $transcations = Transaction::where('user_id',$userid)->get()->toArray();
        //$transcations = Transaction::all();
        return view('state',compact('transcations'));
    }

    public function save(Request $request)
    {
        $request = $request->validate([
            'address' => 'required|regex:/0x[a-fA-F0-9]{40}/',
            'pcoin' => 'required|numeric',
        ]);

        $user = Auth::user();
        $userid = $user->id;
        if ( $user->pcoin < (int)$request['pcoin'] )
            return back()->withErrors('P幣不足');
        else {
            $newtrans = new Transaction;
            $newtrans->user_id = $userid;
            $newtrans->state = 'done';
            $newtrans->address = $request->address ;
            $newtrans->token = (float)$request->pcoin * 1000;
            $newtrans->pcoin = (int)$request->pcoin;
            $newtrans->created_at = Carbon::now();
            $user->pcoin -= $newtrans->pcoin;
            $user->save();
            $newtrans->save();
        }
        $transcations = Transaction::where('user_id',$userid)->get()->toArray();
        return view('state',compact('transcations'));
    }
}
