<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function admin(){
        $alo = ["alo"];
        if(Auth::guard('admin')->check()){
            return view('pages.adminpanel',['alo' => $alo]);
        }
        else{
            return redirect()->intended(route('login'));
        }
    }

    public function getUsers(){
        $allusers = User::selectRaw('*')->get();
        return view('pages.adminusers',['users' => $allusers]);
    }

    public function editUser($username){
        if(Auth::guard('admin')->check()){
            $user = User::where('username', $username)->first();
            return view('pages.adminuserdetails',['user' => $user]);
        }
        else{
            return redirect()->intended(route('login'));
        }
    }

    public function getAuctions(){
        $users = array();

        $allact = Auction::selectRaw('*')->orderBy('idauction','asc')->get();
        $arrAll [] =[];
        foreach($allact as $act) {
            $arr [] =[];
            $user  = User::selectRaw('*')
                ->where('idclient','=',$act->idowner)
                ->get()
                ->first();

            $arr["name"] = $act->name;
            $arr["idauction"] = $act->idauction;  
            $arr["owner"] = $user->username;

            array_push($arrAll, $arr);
        }
        array_shift($arrAll);
        return view('pages.adminauctions',['auctions' => $arrAll]);
    }

    public function getBids(){
        $allbids = Bid::selectRaw('*')->get();
        return view('pages.adminbids',['bids' => $allbids]);
    }
}
