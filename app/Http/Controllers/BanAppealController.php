<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class BanAppealController extends Controller
{
    public function banappeal(){

        if(Auth::user()){
            //get all ban appeals
            /*$ban_appeals = BanAppeal::selectRaw('*')
                ->where('idclient','=',Auth::user()->idclient)
                ->get();*/
            return view('pages.banappeal', []);

        }
        else{

            return redirect()->intended(route('login'));
        }

    }
}

