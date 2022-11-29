<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\User;

class SearchController extends Controller
{
    public function getSearchResultsJson() {
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


        if($category === 0) {
            $auctions = Auction::ftsSearch($search_query)->get();
        }
        else {
            $auctions = Auction::ftsSearchCat($search_query,$category)->get();
        }
        return json_encode($auctions);
    }

    public function getSearchUserResultsJson() {
        if (!isset($_GET['search_query']) || $_GET['search_query'] == "") {
            $users = User::all();
            return json_encode($users);
        }
        else{
            $search_query = $_GET['search_query'];
        }
        $users = User::searchUser($search_query)->get();

        return json_encode($users);
    }

    public function getSearchActionsResultsJson() {
        if (!isset($_GET['search_query']) || $_GET['search_query'] == "") {
            $users = Auction::getAll()->get();
            return json_encode($users);
        }
        else{
            $search_query = $_GET['search_query'];
        }
        $users = Auction::searchWithUser($search_query)->get();
        return json_encode($users);
    }

    public function homeCatgorySearch($category){
        $categories = Category::selectRaw('*')->get();
        if (!isset($_GET['search_query']) || $_GET['search_query'] == ""){
            $search_query = '';
            $auctions = Auction::where('idcategory', $category)->where('isover',false)->get();
        }
        else{
            $search_query = $_GET['search_query'];
            $auctions = Auction::ftsSearchCat($search_query,$category)->get();
        }
        return view('pages.search',['auctions' => $auctions,'text_to_default' =>$search_query,'category' => $categories]);
    }
    
    public function home() {
        $categories = Category::selectRaw('*')->get();
        if (!isset($_GET['search_query']) || $_GET['search_query'] == ""){
            $search_query = '';
            $auctions = Auction::all();
        }
        else{
            $search_query = $_GET['search_query'];
            $auctions = Auction::ftsSearch($search_query)->get();
        }
        return view('pages.search',['auctions' => $auctions,'text_to_default' =>$search_query,'category' => $categories]);
    }
}
