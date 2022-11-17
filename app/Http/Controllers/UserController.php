<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Auction;

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
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.profile',['user' => $user]);
    }

    public function details($id)
    {
        $user = User::find($id);
        return view('pages.mydetails',['user' => $user]);
    }

    public function myAuctions($id){
        $user = User::find($id);
        $auctions = $user->auctions;
        $myauctions = Auction::selectRaw('*')->where('isover','=','False')->where('idowner','=',$id)->get();


        return view('pages.userAuctions',['user' => $user, 'auctions' => $myauctions]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function balance($id)
    {
        $user = User::find($id);
        return view('pages.balance',['user' => $user]);
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
        $user = User::find($id);
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
