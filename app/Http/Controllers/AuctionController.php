<?php

namespace App\Http\Controllers;

use App\Models\AuctionOwner;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Bid;
use Auth;

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
        if(Auth::check() || Auth::guard('admin')->check()){
            $lastId = Auction::selectRaw('idauction')->orderBy('idauction','desc')->first()->idauction;

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
        return view('pages.auction',['auction' => $auction, 'owner' => $owner, 'category' =>  $category, 'bids' => $bids]);
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
        //valores a dar update
        $name = $request->input('nome');
        $catName = $request->input('cats');
        $categ = Category::select('idcategory')->where('name','=',$catName)->get();
        foreach($categ as $idcat) {
            $idCategory = $idcat->idcategory;
        }
        $desc =  $request->input('desc');
        $price = (float)substr($request->input('price'), 0, -1);
        $enddate = (string)$request->input('enddate');

        //checks
        if(!is_numeric($price)){
            return redirect()->back()->withErrors(['error' => 'The amount must be an integer!']);
        }
        if($price <= 0) {
            return redirect()->back()->withErrors(['error' => 'The amount must be a number!']);
        }
        if(!date('Y-m-d H:i:s', strtotime($enddate)) == $enddate) {
            return redirect()->back()->withErrors(['error' => 'The end date is not valid!']);
        }

        Auction::where('idauction', $id)->update(['name' => $name,'startingprice' => $price, 'enddate' => $enddate, 'description' => $desc, 'idcategory' => $idCategory ]);
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

        if(Auth::id() == $auction->idowner || Auth::guard('admin')->check())
        {
            $auction->delete();

            return redirect('/');
        }
        else{
            abort(403);
        }
    }

}
