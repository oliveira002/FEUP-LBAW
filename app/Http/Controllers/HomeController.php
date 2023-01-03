<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\FavoriteAuction;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class HomeController extends Controller
{
    public function home() {
        $soonAuction = Auction::selectRaw('*')
            ->where('isover','=','False')
            ->orderBy('enddate','asc')
            ->limit(3)
            ->get();
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


        $categories = Category::selectRaw('*')
            ->get();
        return view('pages.home',['auctions' => $soonAuction, 'categories' => $categories, 'favorites' => $favorite_auctions, 'notifications' => $notifications]);
    }
}
