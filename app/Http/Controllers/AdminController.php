<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionReport;
use App\Models\BanAppeals;
use App\Models\Bid;
use App\Models\SellerReport;
use App\Models\SystemManagerLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers;

use Auth;
use phpDocumentor\Reflection\Types\Boolean;
use PhpParser\Node\Expr\Cast\Bool_;
use Ramsey\Uuid\Type\Integer;

class AdminController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/';

    public function admin(){

        $numUsers = count(User::selectRaw('*')->get());
        $numAuc = count(Auction::selectRaw('*')->get());
        $numBids = count(Bid::selectRaw('*')->get());
        if(Auth::guard('admin')->check()){
            return view('pages.adminpanel',['numUsers' => $numUsers,'numAuc' => $numAuc,'numBids' => $numBids]);
        }
        else{
            return redirect()->intended(route('login'));
        }
    }

    public function getUsers(){
        if(!Auth::guard('admin')->check()){
            abort(403);
        }
        $allusers = User::selectRaw('*')->get();
        return view('pages.adminusers',['users' => $allusers]);
    }

    public function editUser($username){
        if(Auth::guard('admin')->check()){
            $user = User::where('username', $username)->first();
            return view('pages.adminuserdetails',['user' => $user]);
        }
        else{
            abort(403);
        }
    }

    public function getAuctions(){

        if(!Auth::guard('admin')->check()){
            abort(403);
        }

        $users = array();

        $allact = Auction::selectRaw('*')->orderBy('idauction','asc')->get();
        $arrAll [] =[];
        foreach($allact as $act) {
            $arr [] =[];
            $user  = User::selectRaw('*')
                ->where('idclient','=',$act->idowner)
                ->get()
                ->first();

            $arr["name"] = $act->name;
            $arr["idauction"] = $act->idauction;
            $arr["owner"] = $user->username;

            array_push($arrAll, $arr);
        }
        array_shift($arrAll);
        return view('pages.adminauctions',['auctions' => $arrAll]);
    }

    public function getBids(){
        if(!Auth::guard('admin')->check()){
            abort(403);
        }

        $allbids = Bid::selectRaw('*')->get();
        return view('pages.adminbids',['bids' => $allbids]);
    }

    public function getSellerReports() {
        if(!Auth::guard('admin')->check()){
            abort(403);
        }

        $allSeller = SellerReport::selectRaw('*')->orderBy('issolved','asc')->orderBy('idreport','asc')->get();
        return view('pages.adminsellreports',['reports' => $allSeller]);
    }

    public function getAuctionReports() {
        if(!Auth::guard('admin')->check()){
            abort(403);
        }

        $allSeller = AuctionReport::selectRaw('*')->orderBy('issolved','asc')->orderBy('idreport','asc')->get();
        return view('pages.adminauctionreports',['reports' => $allSeller]);
    }

    public function createUser(){
        if(Auth::guard('admin')->check()){
            return view('pages.admincreateuser');
        }
        else{
            abort(403);
        }
    }

    public function getLogs(){
        if(!Auth::guard('admin')->check()){
            abort(403);
        }

        $logs = SystemManagerLog::selectRaw('*')->get();
        return view('pages.adminlogs',['logs' => $logs]);
    }

    public function getBanAppeals(){
        if(!Auth::guard('admin')->check()){
            abort(403);
        }

        $appeals = BanAppeals::selectRaw('*')->get();
        return view('pages.adminbanappeals',['appeals' => $appeals]);
    }

    public function banUser($id){
        if(!Auth::guard('admin')->check()){
            abort(403);
        }

        $user = User::find($id);

        if(!$user->isbanned){
            $user->update(['isbanned' => "1"]);

            SystemManagerLog::create([
                'idsysman' => Auth::guard('admin')->id(),
                'logdescription' => 'Banned user with ID: ' . $id,
                'logdate' => date('Y-m-d H:i:s'),
                'logtype' => 'Ban',
            ]);

            return redirect()->back()->withErrors(["success"=>"User was banned!"]);
        }

        return redirect()->back()->withErrors(["success"=>"User was already banned!"]);
    }

    public function destroyBanAppeal($id, $unban)
    {
        $ban_appeal = BanAppeals::find($id);

        if(Auth::guard('admin')->check())
        {
            if(!$unban){
                SystemManagerLog::create([
                    'idsysman' => Auth::guard('admin')->id(),
                    'logdescription' => 'Refused Ban appeal with ID: ' . $ban_appeal->idbanappeal,
                    'logdate' => date('Y-m-d H:i:s'),
                    'logtype' => 'other',
                ]);
            }

            $ban_appeal->delete();
            return redirect()->back();
        }
        else{
            abort(403);
        }
    }

    public function unbanUser(Request $request){
        if(!Auth::guard('admin')->check()){
            abort(403);
        }

        $user = User::find($request->id);

        if($user->isbanned){
            $user->update(['isbanned' => "0"]);
            $this->destroyBanAppeal($request->idbanappeal, true);

            SystemManagerLog::create([
                'idsysman' => Auth::guard('admin')->id(),
                'logdescription' => 'Unbanned user with ID: ' . $request->id,
                'logdate' => date('Y-m-d H:i:s'),
                'logtype' => 'Unban',
            ]);
        }

        return redirect()->back()->withErrors(["success"=>"User was unbanned!"]);

    }


}
