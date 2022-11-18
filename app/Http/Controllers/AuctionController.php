<?php

namespace App\Http\Controllers;

use App\Models\AuctionOwner;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auction;

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
    public function show($id)
    {
        $auction = Auction::find($id);
        $owner = User::find($auction->idowner);
        $category = Category::find($auction->idcategory);
        return view('pages.auction',['auction' => $auction, 'owner' => $owner, 'category' =>  $category]);
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
        $auction = Auction::find($id);
        $name = $request->input('nome');
        $catName = $request->input('cats');
        $categ = Category::select('idcategory')->where('name','=',$catName)->get();
        foreach($categ as $idcat) {
            $idCategory = $idcat->idcategory;
        }
        $desc =  $request->input('desc');
        $price = (float)substr($request->input('price'), 0, -1);
        $enddate = (string)$request->input('enddate');

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
        //
    }

}
