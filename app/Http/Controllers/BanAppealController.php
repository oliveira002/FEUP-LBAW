<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\BanAppeals;

class BanAppealController extends Controller
{
    public function banappeal(){

        if(Auth::user()){
            //check if user is banned
            $user = Auth::user();
            if($user->isbanned)
            {
                $ban_appeals = BanAppeals::selectRaw('*')
                ->where('idclient','=',Auth::user()->idclient)
                ->get();
                return view('pages.banappeal', ['ban_appeals' => $ban_appeals]);

            }
            else
            {

                return redirect()->route('/');
            }

        }
        else{

            return redirect()->intended(route('login'));
        }

    }
}

