<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Transaction;


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
        dd($user);
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

        public function form()
    {
        return view('form');
    }
}
