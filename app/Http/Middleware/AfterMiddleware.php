<?php

namespace App\Http\Middleware;
 
use Closure;
use App\Models\Auction;

class AfterMiddleware
{
    public function handle($request, Closure $next)
    {
        $auctions = Auction::all();
        foreach($auctions as $auction){
            if($auction->isover){
                continue;
            }
            if($auction->enddate < date('Y-m-d H:i:s')){
                $auction->isover = true;
                $auction->save();
            }
        }
 
        return $next($request);
    }
}