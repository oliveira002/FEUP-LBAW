<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\AuctionOwner;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class SearchController extends Controller
{
    public function getSearchResultsJson() {

        if(Auth::user()){
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
        }

        if (!isset($_GET['display'])) {
            $display = 0;
        }
        else{
            $display = $_GET['display'];
        }
        if(!is_numeric($display)){
            $display = 0;
        }

        if (!isset($_GET['sort'])) {
            $sort = 0;
        }
        else{
            $sort = $_GET['sort'];
        }
        if(!is_numeric($sort)){
            $sort = 0;
        }

        if (!isset($_GET['min'])) {
            $min = 0;
        }
        else{
            $min = $_GET['min'];
        }
        if(!is_numeric($min)){
            $min = 0;
        }

        if (!isset($_GET['max'])) {
            $max = 100000000;
        }
        else{
            $max = $_GET['max'];
        }
        if(!is_numeric($max)){
            $max = 100000000;
        }

        if (!isset($_GET['category'])) {
            $category = 0;
        }
        else{
            $category = $_GET['category'];
        }
        if(!is_numeric($category)){
            $category = 0;
        }
        $auctions = [];
        $bool = 0;
        if (!isset($_GET['search_query']) || $_GET['search_query'] == "") {
            if($category === 0) {
                $auctions = Auction::all();
                //return json_encode($auctions);
            }
            else{
                $auctions = Auction::where('idcategory', $category)->get();
                //return json_encode($auctions);
            }
        }
        else{
            $bool = 1;
            $search_query = $_GET['search_query'];
        }

        if($bool === 1){
            if($category === 0) {
                $auctions = Auction::ftsSearch($search_query)->get();
            }
            else {
                $auctions = Auction::ftsSearchCat($search_query,$category)->get();
            }
        }

        $filtered_collection = $auctions->filter(function ($item) use ($display,$sort,$min, $max) {
            if(!($min <= $item->currentprice && $item->currentprice <= $max)){
                return false;
            }
            else if($display == 0 && $item->isover === true){
                return false;
            }
            else if($display == 1 && $item->isover === false){
                return false;
            }
            return true;
        })->values();

        $sorted_collection = $filtered_collection->sortBy(function($auction) use ($sort){
            if($sort == 0){
                return $auction->currentprice;
            }
            else if($sort == 1){
                $var = Bid::where('idauction', $auction->idauction)->count();
                return $var;
            }
            else if($sort == 2){
                $var = AuctionOwner::where('idclient', $auction->idowner)->first()->rating;
                return $var;
            }
            else{
                return $auction->currentprice;
            }

        })->values();
        return json_encode($sorted_collection);
    }

    public function getSearchUserResultsJson() {

        if(Auth::user()){
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
        }
        $this->authorize('viewAllUsers', User::class);


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

    public function getSearchAuctionsResultsJson() {

        if(Auth::user()){
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
        }
        $this->authorize('viewAllUsers', User::class);

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

        if(Auth::user()){
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
        }

        $categories = Category::selectRaw('*')->get();
        if (!isset($_GET['search_query']) || $_GET['search_query'] == ""){
            $search_query = '';
            $auctions = Auction::where('idcategory', $category)->where('isover',false)->get();
        }
        else{
            $search_query = $_GET['search_query'];
            $auctions = Auction::ftsSearchCat($search_query,$category)->get();
        }
        if(Auth::user()){
            $notifications = Notification::selectRaw('*')
                    ->where('idclient','=',Auth::user()->idclient)
                    ->where('isread','=','False')
                    ->orderBy('notifdate','desc')
                    ->get();
        }
        else{
            $notifications = null;
        }
        $filtered_collection = $auctions->filter(function ($item)  {
            if($item->isover === true){
                return false;
            }
            return true;
        })->values();
        return view('pages.search',['auctions' => $filtered_collection,'text_to_default' =>$search_query,'category' => $categories,'notifications' => $notifications]);
    }

    public function home() {

        if(Auth::user()){
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
        }

        $categories = Category::selectRaw('*')->get();
        if (!isset($_GET['search_query']) || $_GET['search_query'] == ""){
            $search_query = '';
            $auctions = Auction::all();
        }
        else{
            $search_query = $_GET['search_query'];
            $auctions = Auction::ftsSearch($search_query)->get();
        }
        if(Auth::user()){
            $notifications = Notification::selectRaw('*')
                    ->where('idclient','=',Auth::user()->idclient)
                    ->where('isread','=','False')
                    ->orderBy('notifdate','desc')
                    ->get();
        }
        else{
            $notifications = null;
        }
        $filtered_collection = $auctions->filter(function ($item)  {
            if($item->isover === true){
                return false;
            }
            return true;
        })->values();
        return view('pages.search',['auctions' => $filtered_collection,'text_to_default' =>$search_query,'category' => $categories,'notifications' => $notifications]);
    }
}
