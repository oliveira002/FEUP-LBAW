<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function auctionPage($id) {
        $auction = Auction::find($id);
        return view('pages.auction',['auction' => $auction]);
    }
}
