<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use Carbon\Carbon;
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

        $minBid = 0.05 * $auction->startingprice;
        $minBid = $minBid + $auction->currentprice - 0.01;


        if(Auth::check()) {
            if(Auth::user()->idclient === $auction->idowner) {
                return redirect()->back()->withErrors(['error' => 'Cannot bid on your own auction']);
            }
        }

        elseif(Auth::guard('admin')->check()) {
            return redirect()->back()->withErrors(['error' => 'An admin cannot do that!']);
        }

        elseif(!Auth::check()) {
            return redirect()->back()->withErrors(['error' => 'Need to login first!']);
        }

        if($auction->enddate < now()) {
            return redirect()->back()->withErrors(['error' => 'Auction finished already!']);
        }

        if($amount < $minBid) {
            return redirect()->back()->withErrors(['error' => 'Bid price is below minimum!']);
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
            if(date('Y-m-d H:i:s', strtotime('+15 minutes')) > $auction->enddate) {
                $auction->enddate = date('Y-m-d H:i:s', strtotime('+30 minutes'));
                $auction->save();
            }
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => 'Your bid cannot be lower than the current price!']);
        }

        return redirect()->route('auction', ['id' => $idauction]);
    }
}
