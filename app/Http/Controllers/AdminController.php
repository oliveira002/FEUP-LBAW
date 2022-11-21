<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

use Auth;

class AdminController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/';

    public function admin(){

        $numUsers = count(User::selectRaw('*')->get());
        $numAuc = count(Auction::selectRaw('*')->get());
        $numBids = count(Bid::selectRaw('*')->get());
        if(Auth::guard('admin')->check()){
            return view('pages.adminpanel',['numUsers' => $numUsers,'numAuc' => $numAuc,'numBids' => $numBids]);
        }
        else{
            return redirect()->intended(route('login'));
        }
    }

    public function getUsers(){
        if(!Auth::guard('admin')->check()){
            abort(403);
        }
        $allusers = User::selectRaw('*')->get();
        return view('pages.adminusers',['users' => $allusers]);
    }

    public function editUser($username){
        if(Auth::guard('admin')->check()){
            $user = User::where('username', $username)->first();
            return view('pages.adminuserdetails',['user' => $user]);
        }
        else{
            abort(403);
        }
    }

    public function getAuctions(){

        if(!Auth::guard('admin')->check()){
            abort(403);
        }

        $users = array();

        $allact = Auction::selectRaw('*')->orderBy('idauction','asc')->get();
        $arrAll [] =[];
        foreach($allact as $act) {
            $arr [] =[];
            $user  = User::selectRaw('*')
                ->where('idclient','=',$act->idowner)
                ->get()
                ->first();

            $arr["name"] = $act->name;
            $arr["idauction"] = $act->idauction;
            $arr["owner"] = $user->username;

            array_push($arrAll, $arr);
        }
        array_shift($arrAll);
        return view('pages.adminauctions',['auctions' => $arrAll]);
    }

    public function getBids(){
        if(!Auth::guard('admin')->check()){
            abort(403);
        }

        $allbids = Bid::selectRaw('*')->get();
        return view('pages.adminbids',['bids' => $allbids]);
    }

    public function createUser(){
        if(Auth::guard('admin')->check()){
            return view('pages.admincreateuser');
        }
        else{
            abort(403);
        }
    }

}
