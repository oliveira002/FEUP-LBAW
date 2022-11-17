<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auction;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(Auth::check()){
            return view('pages.profile',['user' => Auth::user()]);
        }
        else{
            return redirect()->intended(route('login'));
        }
    }

    public function details()
    {
        if(Auth::check()){
            return view('pages.mydetails',['user' => Auth::user()]);
        }
        else{
            return redirect()->intended(route('login'));
        }
    }

    public function myAuctions(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{
            return redirect()->intended(route('login'));
        }
        $id = $user->id;
        $myauctions = Auction::selectRaw('*')->where('isover','=','False')->where('idowner','=',$id)->get();
        return view('pages.userAuctions',['user' => $user, 'auctions' => $myauctions]);

    }

    public function myBids(){
        if(Auth::check()){
            $user = Auth::user();
        }
        else{
            return redirect()->intended(route('login'));
        }
        $id = $user->id;
        $mybids = Bid::selectRaw('*')->where('idclient','=',$id)->get();
        return view('pages.user_bids',['user' => $user, 'bids' => $mybids]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function auctionById($id){
        $auction = Auction::find($id);
        $owner = User::find($auction->idclient);
        return view('pages.auction',['auction' => $auction, 'owner' => $owner]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function balance()
    {
        if(Auth::check()){
            return view('pages.balance',['user' => Auth::user()]);
        }
        else{
            return redirect()->intended(route('login'));
        }
    }

    /**
     * Add deposit to user balance
     *
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function addFunds($id,Request $request)
    {
        if(Auth::check()){
            $user = Auth::user();
        }
        else{
            return redirect()->intended(route('login'));
        }
        $user->balance = $user->balance + $request->input('amount');
        $user->save();
        return redirect()->route('balance', ['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
