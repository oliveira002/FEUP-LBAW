<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Auction;
use Illuminate\Support\Facades\DB;
use Auth;

class BidController extends Controller
{
    public function createBid(Request $request)
    {

        $amount = $request->input('amount');

        $idauction = (int) $request->route('id');
        DB::beginTransaction();
        $auction = Auction::find($idauction);

        $minBid = 0.05 * $auction->startingprice;
        $minBid = $minBid + $auction->currentprice - 0.01;

        $client = Bid::join('auction', 'bid.idauction', '=', 'auction.idauction')
            ->select('idclient')
            ->where('bid.idauction', $idauction)
            ->where('auction.idauction', $idauction)
            ->groupBy('bid.idclient', 'bid.price', 'auction.name')
            ->orderBy('price', 'desc')
            ->first();

        if($client) {
            $maxId = $client->idclient;
        }
        else {
            $maxId = -1;
        }

        if(Auth::check()) {
            if(Auth::user()->idclient === $auction->idowner) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => 'Cannot bid on your own auction']);
            }
        }

        elseif(Auth::guard('admin')->check()) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'An admin cannot do that!']);
        }

        elseif(!Auth::check()) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Need to login first!']);
        }

        if($auction->enddate < now()) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Auction finished already!']);
        }

        if($amount < $minBid) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Bid price is below minimum!']);
        }

        if(Auth::user()->idclient === $maxId) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'You cannot outbid yourself!']);
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
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'The amount must be an integer!']);
        }
        try{
            $bid->save();
            if(date('Y-m-d H:i:s', strtotime('+15 minutes')) > $auction->enddate) {
                $auction->enddate = date('Y-m-d H:i:s', strtotime('+30 minutes'));
                $auction->save();
            }
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Your bid cannot be lower than the current price!']);
        }

        return redirect()->route('auction', ['id' => $idauction]);
    }
}
