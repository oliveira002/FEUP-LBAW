<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\FavoriteAuction;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FAQController extends Controller
{
    public function faqs(){
        $faqs = ["What is WeBid?",
            "How do I participate in an auction?",
            "Do I need to pay to have an account on WeBid?",
            "Is it safe to buy on WeBid?",
            "Can I cancel an auction after creating one?",
            "What's the minimum increase on bids",
            "I have the highest bid, can I consider the item as mine?",
            "Can I put more than one item up for sale at the same time?",
            "I placed a bid and now I regret it, can I cancel it?"];
        $faqs_text = ["WeBid is an online auction website were people can put their items for auction and wait for people to bid on them.",
            "To participate in an auction, first you have to find an item you want to buy. Then, go to it's auction page where you can see more detailed information about the product like pictures, item description, and asking/current price. If you're sure that's the item you want to attempt to purchase, you can place a bid. After a certain time, the highest bidding user wins the auction.",
            "Creating an account on WeBid is free. Accounts are needed in order to be able to place bids on an auction.",
            "Yes. All personal data is stored according to European Union laws. Furthermore, if an auction owner or auction winner refuses to sell/buy the product, we will handle that personally.",
            "It depends. If the auction already has bids you cannot cancel it, as that would be abusive and unfair towards other people using the service, but if the auction has no bids, you can cancel it freely.",
            "Each new bid has a minimum increase of 5% of the base price from the previous bid. This is to stimulate a competitive environment and prevent minimal increases inbetween bids.",
            "No. Until the auction's over, you can't say for sure the item is yours, as someone might place a big higher than yours.",
            "Yes, you're allowed to have multiple auctions up at the same time.",
            "Unfortunately, all bids are final. You'll have to wait for someone to outbid you."];

        if(Auth::user()){
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
            $favorites = FavoriteAuction::selectRaw('*')
                ->where('idclient','=',Auth::user()->idclient)
                ->limit(3)
                ->get();
            $favorite_auctions = array();
            foreach($favorites as $favorite) {

                $auction = Auction::selectRaw('*')
                    ->where('idauction','=',$favorite->idauction)
                    ->first();
                array_push($favorite_auctions, $auction);

            }
            $notifications = Notification::selectRaw('*')
                ->where('idclient','=',Auth::user()->idclient)
                ->where('isread','=','False')
                ->orderBy('notifdate','desc')
                ->get();
        }
        else{
            $favorite_auctions = null;
            $notifications = null;
        }

        return view('pages.faq',['faqs' => $faqs, 'faqs_text' => $faqs_text,'favorites' => $favorite_auctions, 'notifications' => $notifications]);
    }
}
