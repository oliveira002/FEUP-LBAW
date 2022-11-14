<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;

class HomeController extends Controller
{
    public function homePage() {
        $soonAuction = Auction::selectRaw('*')
            ->where('isover','=','False')
            ->orderBy('enddate','asc')
            ->limit(3)
            ->get();
        return view('pages.home',['auctions' => $soonAuction]);
    }
}
