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

    public function bindAddress(Request $request)
    {
        $request = $request->validate([
            'address' => 'required|regex:/0x[a-fA-F0-9]{40}/',
        ]);
        
        $user = Auth::user();
        $bindReq = $this->pttBind($user->pttid, $request['address']);
        if ($bindReq != "success")
            return redirect()->route('home')->withErrors(array('message' => $bindReq));

        $user->address = $request['address'];
        $user->save();
        
        return redirect()->route('home');
    }
    
    
    public function addTrans(Request $request)
    {
        $request = $request->validate([
            'pcoin' => 'required|numeric',
        ]);

        $user = Auth::user();
        $userid = $user->id;
        if ( $user->pcoin < (int)$request['pcoin'] || (int)$request['pcoin'] <= 0 )
            return back()->withErrors('P幣不足');
        else {
            $exchangeReq = $this->pttCoinExchange($user->address, (int)$request['pcoin']);
            if ($exchangeReq == "success") {
                $newtrans = new Transaction;
                $newtrans->user_id = $userid;
                $newtrans->state = 'done';
                $newtrans->address = $user->address;
                $newtrans->token = (float)$request['pcoin'] * 1000;
                $newtrans->pcoin = (int)$request['pcoin'];
                $newtrans->created_at = Carbon::now();
                $user->pcoin -= $newtrans->pcoin;
                $user->save();
                $newtrans->save();
            }
            else {
                $newtrans = new Transaction;
                $newtrans->user_id = $userid;
                $newtrans->state = 'failed';
                $newtrans->address = $user->address;
                $newtrans->token = (float)$request['pcoin'] * 1000;
                $newtrans->pcoin = (int)$request['pcoin'];
                $newtrans->created_at = Carbon::now();
                $newtrans->save();
                return redirect()->route('home')->withErrors(array('message' => $exchangeReq));
            }
        }
        $transcations = Transaction::where('user_id',$userid)->get()->toArray();
        return redirect()->route('state',compact('transcations'));
    }
    
    
    
    public function pttBind($pttid, $address)
    {
        $pttBind = array('pttid' => $pttid, 'address' => $address, 'signature' => $pttid);

        $pttBindJSON = json_encode($pttBind);
        // dd($pttBindJSON);

        // $postdata = http_build_query($pttBindJSON);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => array('Accept: application/json','Content-Type: application/json'),
                'content' => $pttBindJSON,
                'timeout' => 15 * 60
            )
        );
        $context = stream_context_create($options);
        $response = file_get_contents('http://home.ntuosc.org:4488/api/pttBind', false, $context);
        $response = json_decode($response, true);
        if ($response["ok"]) return "success";
        else return $response["msg"];
        
    }

    public function pttCoinExchange($address, $amount)
    {
        $pttBind = array('address' => $address, 'amount' => $amount, 'signature' => 'Convert '.$amount.' P to tokens');

        $pttBindJSON = json_encode($pttBind);
        // dd($pttBindJSON);

        // $postdata = http_build_query($pttBindJSON);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => array('Accept: application/json','Content-Type: application/json'),
                'content' => $pttBindJSON,
                'timeout' => 15 * 60
            )
        );
        $context = stream_context_create($options);
        $response =  file_get_contents('http://home.ntuosc.org:4488/api/pttCoinExchange', false, $context);
        $response = json_decode($response, true);
        if ($response["ok"]) return "success";
        else return $response["msg"];
    }
}
