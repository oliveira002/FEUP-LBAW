<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin(){
        $alo = ["alo"];
        return view('pages.adminpanel',['alo' => $alo]);
    }

    public function getUsers(){
        $allusers = User::selectRaw('*')->get();
        return view('pages.adminusers',['users' => $allusers]);
    }

    public function getAuctions(){
        $users = array();

        $allact = Auction::selectRaw('*')->orderBy('idauction','asc')->get();

        foreach($allact as $act) {
            $user  = User::selectRaw('*')
                ->where('idclient','=',$act->idowner)
                ->get();

            $users[] = $user;
        }
        return view('pages.adminauctions',['auctions' => $allact,'owners' => $users]);
    }

    public function getBids(){
        $allbids = Bid::selectRaw('*')->get();
        return view('pages.adminbids',['bids' => $allbids]);
    }
}
