<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Auction;
use Illuminate\Support\Facades\DB;
use App\Models\Bid;
use App\Models\Notification;

class AfterMiddleware
{
    public function handle($request, Closure $next)
    {
        DB::beginTransaction();
            try{
                $auctions = Auction::all();
                foreach($auctions as $auction){
                    if($auction->isover){
                        continue;
                    }
                    elseif($auction->enddate < date('Y-m-d H:i:s')){
                        $auction->isover = true;
                        $auction->save();

                        $bid = Bid::selectRaw('*')
                            ->where('idauction', $auction->idauction)
                            ->where('isvalid', true)
                            ->orderBy('price', 'desc')->first();

                        if($bid){
                            Notification::create([
                                'idclient' => $bid->idclient,
                                'notifdate' => date('Y-m-d H:i:s'),
                                'content' => 'You won the auction: ' . $auction->name,
                                'isread' => false
                            ]);
                            Notification::create([
                                'idclient' => $auction->idowner,
                                'notifdate' => date('Y-m-d H:i:s'),
                                'content' => 'Your auction ' . $auction->name . ' has Ended.' ,
                                'isread' => false
                            ]);
                            $bids = Bid::selectRaw('*')
                                ->where('idauction', $auction->idowner)
                                ->where('isvalid', true)
                                ->where('idclient', '!=', $bid->idclient)
                                ->groupBy('idclient','idbid')
                                ->get();
                            foreach($bids as $bid1){
                                Notification::create([
                                    'idclient' => $bid1->idclient,
                                    'notifdate' => date('Y-m-d H:i:s'),
                                    'content' => 'A auction you participated has ended ' . $auction->name,
                                    'isread' => false
                                ]);
                            }
                        }
                    }
                    elseif($auction->enddate === date('Y-m-d H:i:s', strtotime('-1 hour'))){
                        $bids = Bid::selectRaw('*')
                                ->where('idauction', $auction->idauction)
                                ->where('isvalid', true)
                                ->groupBy('idclient')
                                ->get();
                        foreach($bids as $bid){
                            Notification::create([
                                'idclient' => $bid->idclient,
                                'notifdate' => date('Y-m-d H:i:s'),
                                'content' => 'A auction you participated is about to end ' . $auction->name,
                                'isread' => false
                            ]);
                        }
                        Notification::create([
                            'idclient' => $auction->idowner,
                            'notifdate' => date('Y-m-d H:i:s'),
                            'content' => 'Your auction ' . $auction->name . ' is about to end.' ,
                            'isread' => false
                        ]);
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        return $next($request);
    }
}
