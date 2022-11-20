<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auction;
use Auth;

class BidController extends Controller
{
    public function createBid(Request $request)
    {

        $amount = $request->input('amount');


        $idauction = (int) $request->route('id');
        $auction = Auction::find($idauction);

        if(Auth::check()) {
            if(Auth::user()->idclient === $auction->idowner) {
                return redirect()->back()->withErrors(['error' => 'You do not have permissions for that :)']);
            }
        }

        elseif(Auth::guard('admin')->check()) {
            return redirect()->back()->withErrors(['error' => 'You do not have permissions for that :)']);
        }

        elseif(!Auth::check()) {
            return redirect()->back()->withErrors(['error' => 'Need to login first!']);
        }

        if($auction->enddate < now()) {
            return redirect()->back()->withErrors(['error' => 'Auction finished already!']);
        }


        $this->authorize("create", Bid::class);

        $lastId = Bid::selectRaw('idbid')->orderBy('idbid','desc')->first()->idbid;
        $user = Auth::user();
        $bid = new Bid();
        $bid->idbid = $lastId + 1;
        $bid->isvalid = true;
        $bid->price = $amount;
        $bid->idauction = $idauction;
        $bid->idclient = $user->idclient;
        $bid->biddate = now();
        if(!is_numeric($amount)){
            return redirect()->back()->withErrors(['error' => 'The amount must be an integer!']);
        }
        try{
            $bid->save();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => 'Your bid cannot be lower than the current price!']);
        }



        return redirect()->route('auction', ['id' => $idauction]);
    }
}
