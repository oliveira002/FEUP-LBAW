<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auction;
use Auth;
use Hash;

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
        $this->authorize("view", Auth::user());
        $auctions = Auction::find(Auth::user()->idclient);
        if(Auth::check()){
            return view('pages.profile',['user' => Auth::user(),'auctions' => $auctions]);
        }
        else{
            return redirect()->intended(route('login'));
        }
    }

    public function showUser($username)
    {

        if(Auth::check()){
            if(Auth::user()->username === $username){
                $auctions = Auction::where('idowner',Auth::user()->idclient)->get();
                return view('pages.profile',['user' => Auth::user(),'auctions'=>$auctions]);
            }
        }
        $user = User::where('username', $username)->first();
        if($user == null){
            abort(404);
            return redirect()->intended(route('/'));
        }
        else{
            $auctions = Auction::where('idowner',$user->idclient)->get();
            return view('pages.userprofile',['user' => $user, 'auctions' => $auctions]);
        }
    }

    public function details()
    {
        $this->authorize("view", Auth::user());
        if(Auth::check()){
            return view('pages.mydetails',['user' => Auth::user()]);
        }
        else{
            return redirect()->intended(route('login'));
        }
    }

    public function myAuctions(){
        $this->authorize("view", Auth::user());
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
        $this->authorize("view", Auth::user());
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
        $this->authorize("view", Auth::user());
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
    public function addFunds(Request $request)
    {
        $this->authorize("update", Auth::user());
        if(Auth::check()){
            $user = Auth::user();
        }
        else{
            return redirect()->intended(route('login'));
        }
        $user->balance = $user->balance + $request->input('amount');
        $user->save();
        return redirect()->back();
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
    public function update(Request $request, $username)
    {

        $user = User::where('username','=',$username)->first();

        if ($request->hasFile('auc_pic')) {
            $image = $request->file('auc_pic');
            $photoName = $user->idclient . '.jpg';
            $image->move('images/users/', $photoName);
        }


        $this->authorize("update", $user);
        $id = $user->idclient;
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phonenumber = $request->input('phonenumber');
        $username = $request->input('username');

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
        return redirect()->route('profile',['username' => $username]);
    }

    public function updatePassword(Request $request){

        $user = Auth::user();
        $curr_pass_input = $request->get('current_password');

        if (!(Hash::check($curr_pass_input, $user->password))) {
            return redirect()->back()->withErrors(["errorCurrPass"=>"Your password is invalid!"]);
        }
        if(strcmp($curr_pass_input, $request->get('new_password')) == 0){
            return redirect()->back()->withErrors(["new_password"=>"New Password cannot be same as your current password!"]);
        }

        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed|alpha_num'
        ]);

        $user->password = bcrypt($request->get('new_password'));
        $user->save();

        return redirect()->back()->withErrors(["success"=>"Your password has been changed successfully!"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        $user = User::find($username);
        $this->authorize("delete", $user);

        $bids = Bid::selectRaw('*')->where('idclient','=',$user->idclient)->get();

        if(count($bids) > 0) {
            return redirect()->back()->withErrors(['error'=>'This user has bids!']);
        }

        if(Auth::guard('admin')->check())
        {
            $user->delete();
            return redirect()->back();
        }
        else{
            abort(403);
        }
    }
}
