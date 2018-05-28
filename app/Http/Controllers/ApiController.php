<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ApiController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pttidExist(Request $request)
    {
        $check = User::where('pttid', $request['pttid'])->first();
        return $check?1:0;
    }
    
    public function checkAddressCoins(Request $request)
    {
        $check = User::where('address', $request['address'])->first();
        return $check?1:0;
    }
}
