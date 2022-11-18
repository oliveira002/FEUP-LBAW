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

        $allact = Auction::selectRaw('*')->get();

        return view('pages.adminauctions',['auctions' => $allact]);
    }

    public static function getOwner($id) {
        $user  = User::selectRaw('*')
            ->where('idclient','=',$id)
            ->get();

        return view('pages.adminauctions',['own' => $user]);
    }

    public function getBids(){
        $allbids = Bid::selectRaw('*')->get();
        return view('pages.adminbids',['bids' => $allbids]);
    }
}
