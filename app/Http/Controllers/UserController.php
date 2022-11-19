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

    public function showUser($username)
    {
        
        return view('pages.profile',['user' => User::where('username',$username)->first()]);
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
        $id = $user->idclient;
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
        $id = $user->idclient;
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

    public function createBid(Request $request)
    {
        $amount = $request->input('amount');


        $idauction = (int) $request->route('id');

        if(Auth::check()){
            $user = Auth::user();
        }
        else{
            return redirect()->intended(route('login'));
        }

        $lastId = Bid::selectRaw('idbid')->orderBy('idbid','desc')->first()->idbid;

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

    /**
     * Add deposit to user balance
     *
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function addFunds(Request $request)
    {
        if(Auth::check()){
            $user = Auth::user();
        }
        else{
            return redirect()->intended(route('login'));
        }
        $user->balance = $user->balance + $request->input('amount');
        $user->save();
        return redirect()->route('balance', ['id' => $user->idclient]);
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
    public function update(Request $request)
    {
        $user = Auth::user();
        $id = $user->idclient;
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phonenumber = $request->input('phonenumber');
        $username = $request->input('phonenumber');

        //checks
        $checkemail = User::selectRaw('*')->where('email','=',$email)->get();
        $checkphone = User::selectRaw('*')->where('phonenumber','=',$phonenumber)->get();
        $checkuser = User::selectRaw('*')->where('username','=',$username)->get();

        if(count($checkemail) != 0 && $email != $user->email) {
            return redirect()->back()->withErrors(['error' => 'Email already used!']);
        }

        if(count($checkphone) != 0 && $phonenumber != $user->phonenumber) {
            return redirect()->back()->withErrors(['error' => 'Phone Number already used!']);
        }

        if(count($checkuser) != 0 && $username != $user->username) {
            return redirect()->back()->withErrors(['error' => 'Username already used!']);
        }

        User::where('idclient', $id)->update(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phonenumber' => $phonenumber , 'username' => $username]);
        return redirect()->route('details');
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
