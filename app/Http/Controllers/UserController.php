<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\FavoriteAuction;
use App\Models\Notification;
use App\Models\SystemManagerLog;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auction;
use Auth;
use Hash;
use Illuminate\Support\Facades\DB;

function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
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
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
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
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
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
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
        }
        else{
            return redirect()->intended(route('login'));
        }
        $id = $user->idclient;
        $myauctions = Auction::selectRaw('*')->where('isover','=','False')->where('idowner','=',$id)->get();
        return view('pages.userAuctions',['user' => $user, 'auctions' => $myauctions]);

    }

    public function favAuctions() {
        $this->authorize("view", Auth::user());
        if(Auth::check()){
            $user = Auth::user();
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
        }
        else{
            return redirect()->intended(route('login'));
        }

        $id = $user->idclient;
        $auctions = Auction::join('favoriteauction', 'auction.idauction', '=', 'favoriteauction.idauction')
            ->where('favoriteauction.idclient', $id)
            ->select('*')
            ->get();
        return view('pages.userfav',['user' => $user, 'auctions' => $auctions]);

    }

    public function myBids(){
        $this->authorize("view", Auth::user());
        if(Auth::check()){
            $user = Auth::user();
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
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
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }

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

        if(Auth::guard('admin')->check()){
            SystemManagerLog::create([
                'idsysman' => Auth::guard('admin')->id(),
                'logdescription' => 'Updated user id: ' . $user->idclient,
                'logdate' => date('Y-m-d H:i:s'),
                'logtype' => 'other',
            ]);
        }

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
        $count1 = Auction::where('idowner','=',$user->idclient)
        ->where('isover','=',false)
        ->count();

        $count2 = DB::select('SELECT COUNT(DISTINCT idbid) FROM bid, auction
        WHERE idClient = ? AND price = (SELECT MAX(price) FROM bid b2 WHERE b2.idAuction = Bid.idAuction) And bid.idAuction = auction.idAuction AND auction.isover = false
        ', [$user->idclient])[0]->count;

        if( $count2 > 0) {
            return redirect()->back()->withErrors(['error'=>'This user has bids!']);
        }
        if( $count1 > 0) {
            return redirect()->back()->withErrors(['error'=>'This user has Active Auctions!']);
        }

        if(Auth::guard('admin')->check())
        {

            SystemManagerLog::create([
                'idsysman' => Auth::guard('admin')->id(),
                'logdescription' => 'Deleted User id: ' . $user->idclient,
                'logdate' => date('Y-m-d H:i:s'),
                'logtype' => 'Delete User',
            ]);

            $user->delete();
            return redirect()->back();
        }
        else{
            abort(403);
        }
    }

    public function suicide($id)
    {

        if(!Auth::check()) {
            return redirect()->back()->withErrors(["success"=>"User was already banned2323!"]);
        }

        $user = User::find($id);

        $count1 = Auction::where('idowner','=',$user->idclient)
            ->where('isover','=',false)
            ->count();

        $count2 = DB::select('SELECT COUNT(DISTINCT idbid) FROM bid, auction
        WHERE idClient = ? AND price = (SELECT MAX(price) FROM bid b2 WHERE b2.idAuction = Bid.idAuction) And bid.idAuction = auction.idAuction AND auction.isover = false
        ', [$user->idclient])[0]->count;

        if( $count2 > 0) {
            return redirect()->back()->withErrors(['error'=>'This user has bids!']);
        }
        if( $count1 > 0) {
            return redirect()->back()->withErrors(['error'=>'This user has Active Auctions!']);
        }

        $user->delete();
        return redirect()->intended(route('/'));
    }

    public function readNotif() {
        if (!isset($_GET['id'])) {
            abort(403);
        }
        else{
            $id= $_GET['id'];
        }

        $notif = Notification::select('*')->where('idnotification','=',$id)->first();

        $notif->isread = 1;
        $notif->save();
        return redirect()->back();
    }

    public function myWinnings() {
        $this->authorize("view", Auth::user());
        if(Auth::check()){
            $user = Auth::user();
            if(Auth::user()->isbanned){
                return redirect()->intended(route('BanAppeal'));
            }
        }
        else{
            return redirect()->intended(route('login'));
        }

        $id = $user->idclient;


        $auctions = Auction::join('bid', 'auction.idauction', '=', 'bid.idauction')
            ->where('bid.idclient', $id)
            ->where('isover','1')
            ->where(function($query) {
                $query->whereColumn('bid.price', '=', DB::raw('(SELECT MAX(bid.price) FROM bid WHERE bid.idauction = auction.idauction)'));
            })
            ->get();


        return view('pages.userwinnings',['auctions' => $auctions,'user' => $user]);
    }

    public function myNotifications() {

        $this->authorize("view", Auth::user());
        if(Auth::check()){
            $user = Auth::user();
        }
        else{
            return redirect()->intended(route('login'));
        }


        $notifications = Notification::selectRaw('*')
            ->where('idclient','=',Auth::user()->idclient)
            ->where('isread','=','False')
            ->orderBy('isread','asc')
            ->orderBy('notifdate','desc')
            ->get();

        return view('pages.mynotifs',['notifications' => $notifications,'user' => $user]);
    }

}
