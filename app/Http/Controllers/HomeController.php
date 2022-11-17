<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Auction;

class HomeController extends Controller
{
    public function home() {
        $soonAuction = Auction::selectRaw('*')
            ->where('isover','=','False')
            ->orderBy('enddate','asc')
            ->limit(3)
            ->get();

        $categories = Category::selectRaw('*')
            ->get();
        return view('pages.home',['auctions' => $soonAuction, 'categories' => $categories]);
    }
}
