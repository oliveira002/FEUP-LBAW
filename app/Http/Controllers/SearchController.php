<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;

class SearchController extends Controller
{
    public function getSearchResults() {
        if (!isset($_GET['category'])) {
            $category = 0;
        }
        else{
            $category = $_GET['category'];
        }
        if(!is_numeric($category)){
            $category = 0;
        }


        if (!isset($_GET['search_query']) || $_GET['search_query'] == "") {
            if($category === 0) {
                $auctions = Auction::all();
                return json_encode($auctions);
            }
            else{
                $auctions = Auction::where('idcategory', $category)->get();
                return json_encode($auctions);
            }
        }
        else{
            $search_query = $_GET['search_query'];
        }


        if($category === "all") {
            $auctions = Auction::ftsSearch($search_query)->get();
        }
        else {
            $auctions = Auction::ftsSearch($search_query)->where('idcategory',$category)->get();
        }
        return json_encode($auctions);
    }
    public function home() {
        $auctions = Auction::all();
        return view('pages.search',['auctions' => $auctions]);
    }
}

