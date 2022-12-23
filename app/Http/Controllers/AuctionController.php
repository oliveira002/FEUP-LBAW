<?php

namespace App\Http\Controllers;

use App\Models\AuctionOwner;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Bid;
use App\Models\FavoriteAuction;
use Auth;
use App\Models\SystemManagerLog;

class AuctionController extends Controller
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
        if(Auth::check() || Auth::guard('admin')->check()){
            $allcategories = Category::all();
            return(view('pages.createauction',['categories' => $allcategories]));
        }
        abort(403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize("web");
        if(Auth::guard('admin')->check()){
            $lastId = Auction::selectRaw('idauction')->orderBy('idauction','desc')->first()->idauction;
            $id = $lastId + 1;
            if ($request->hasFile('auc_pic')) {
                $image = $request->file('auc_pic');
                $photoName = '1.jpg';
                $image->move('images/' . ($id), $photoName);
            }

            $auction = Auction::create([
                'idauction' => $lastId+1,
                'name' => $request->input('name'),
                'startdate' => date('Y-m-d H:i:s'),
                'enddate' => date('Y-m-d H:i:s', strtotime($request->input('enddate'))),
                'startingprice' => $request->input('price'),
                'currentprice' => $request->input('price'),
                'description' => $request->input('desc'),
                'isover' => 'False',
                'idcategory' => $request->input('cat'),
                'idowner' => Auth::id(),
            ]);

            return redirect()->route('auction', ['id' => ($auction->idauction)]);
        }
        abort(403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bids = Bid::select('*')->where('idauction','=',$id)->get();
        $auction = Auction::find($id);
        $this->authorize("view", $auction);
        if(is_null($auction)) abort(404);
        $owner = User::find($auction->idowner);
        if(is_null($owner)) abort(404);
        $category = Category::find($auction->idcategory);
        if(is_null($category)) abort(404);
        $isfavorite = FavoriteAuction::where('idclient','=',Auth::id())->where('idauction','=',$auction->idauction)->exists();

        return view('pages.auction',['auction' => $auction, 'owner' => $owner, 'category' =>  $category, 'bids' => $bids, 'isfavorite' => $isfavorite]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $auction = Auction::find($id);

        if(Auth::check()) {
            if(Auth::user()->idclient != $auction->idowner) {
                return redirect()->back()->withErrors(['error' => 'You do not have permissions for that :)']);
            }
        }

        elseif(!Auth::guard('admin')->check()) {
            return redirect()->back()->withErrors(['error' => 'You do not have permissions for that :)']);
        }
        $this->authorize("update", $auction);

        $owner = User::find($auction->idowner);
        $category = Category::find($auction->idcategory);
        $allcategories = Category::all();

        return view('pages.edit',['auction' => $auction, 'owner' => $owner, 'category' =>  $category, 'categories' => $allcategories]);
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
        //verificar se ha bids

        $bids = Bid::select('*')->where('idauction','=',$id)->get();
        $auction = Auction::find($id);

        if(Auth::check()) {
            if(Auth::user()->idclient != $auction->idowner) {
                return redirect()->back()->withErrors(['error' => 'You do not have permissions for that :)']);
            }
        }

        elseif(!Auth::guard('admin')->check()) {
            return redirect()->back()->withErrors(['error' => 'You do not have permissions for that :)']);
        }

        if(count($bids) != 0) {
            return redirect()->back()->withErrors(['error' => 'Auction has bids already']);
        }

        $this->authorize("update", $auction);

        if ($request->hasFile('auc_pic')) {
            $image = $request->file('auc_pic');
            $photoName = '1.jpg';
            $image->move('images/' . ($id), $photoName);
        }

        Auction::where('idauction', $id)->update([
            'name' => $request->input('name'),
            'idcategory' => $request->input('cat'),
            'description' => $request->input('desc'),
            'startingprice' => $request->input('price'),
            'currentprice' => $request->input('price'),
            'enddate' => date('Y-m-d H:i:s', strtotime($request->input('enddate'))),
        ]);

        if(Auth::guard('admin')->check()){
            SystemManagerLog::create([
                'idsysman' => Auth::guard('admin')->id(),
                'logdescription' => 'Edit Auction' . $auction->idauction,
                'logdate' => date('Y-m-d H:i:s'),
                'logtype' => 'Update Auction',
            ]);
        }

        return redirect()->route('auction', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $auction = Auction::find($id);
        $this->authorize("delete", $auction);

        if(Auth::guard('admin')->check()){
            SystemManagerLog::create([
                'idsysman' => Auth::guard('admin')->id(),
                'logdescription' => 'Delete Auction' . $auction->idauction,
                'logdate' => date('Y-m-d H:i:s'),
                'logtype' => 'Update Auction',
            ]);
        }

        if(Auth::id() == $auction->idowner || Auth::guard('admin')->check())
        {
            $auction->delete();
            return redirect()->route('/');
        }
        else{
            abort(403);
        }
    }

    /**
     * Add or remove auction from favorites
     * 
     * 
     * 
     */
    public function favorite()
    {

    
    
        if (!isset($_GET['idauction'])) {
            abort(403);
        }
        else{
            $idauction = $_GET['idauction'];
        }


        //check if auction is already in favorites
 
        
 
        //$this->authorize("favorite", $auction);
      
        if(Auth::user()) {
            $user = Auth::user();
            $idclient = $user->idclient;
            $fav = FavoriteAuction::select('*')->where('idclient','=',$idclient)->where('idauction','=',$idauction)->get();
            if(count($fav)==0){
           
                //add to favourite auction
                if($idclient == $user->idclient && $idauction != 0) {
                    $fav = new FavoriteAuction();
                    $fav->idclient = $idclient;
                    $fav->idauction = $idauction;
                    $fav->save();
                    return json_encode(1);
                }
            }
            else{
                //remove from favourite auction
                if($idclient == $user->idclient && $idauction != 0) {
                    $fav = FavoriteAuction::select('*')->where('idclient','=',Auth::user()->idclient)->where('idauction','=',$idauction)->first();
                    $fav->delete();
                    return json_encode(0);
                }
            }
            
            

        }
        elseif (Auth::guard('admin')->check()) {
            
            return json_encode(-1);
        }
        else{
            return json_encode(-2);
        }
    }

}
