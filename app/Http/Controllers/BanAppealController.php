<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\BanAppeals;
use Illuminate\Http\Request;

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

    public function submit(Request $request){

        if(Auth::user()){

            $user = Auth::user();
            $nr_appeals = BanAppeals::where('idclient', '=', $user->idclient)->count();


            if($user->isbanned && $nr_appeals == 0){
                $lastId = BanAppeals::selectRaw('idbanappeal')->orderBy('idbanappeal','desc')->first()->idbanappeal;
                BanAppeals::create([
                    'idbanappeal' => $lastId+1,
                    'appealdescription' => $request->desc,
                    'appealdate' => date('Y-m-d H:i:s'),
                    'idclient' => $user->idclient,
                ]);
                return redirect()->intended(route('BanAppeal'));
            }else{
                return redirect()->back()->withErrors(['error', 'You already have an active ban appeal, wait for a response!']);
            }
        }else{

            return redirect()->intended(route('login'));
        }
    }
}

