<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\FavoriteAuction;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutUsController extends Controller
{
    public function aboutus(){

        if(Auth::user()){
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
            $favorites = FavoriteAuction::selectRaw('*')
                ->where('idclient','=',Auth::user()->idclient)
                ->limit(3)
                ->get();
            $favorite_auctions = array();
            foreach($favorites as $favorite) {

                $auction = Auction::selectRaw('*')
                    ->where('idauction','=',$favorite->idauction)
                    ->first();
                array_push($favorite_auctions, $auction);

            }
            $notifications = Notification::selectRaw('*')
                ->where('idclient','=',Auth::user()->idclient)
                ->where('isread','=','False')
                ->orderBy('notifdate','desc')
                ->get();
        }
        else{
            $favorite_auctions = null;
            $notifications = null;
        }

        return view('pages.aboutus', ['favorites' => $favorite_auctions, 'notifications' => $notifications]);
    }
}

