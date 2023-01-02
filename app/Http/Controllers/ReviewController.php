<?php

namespace App\Http\Controllers;

use App\Models\AuctionReport;
use App\Models\Bid;
use App\Models\Review;
use App\Models\SellerReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
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
    public function createReview(Request $request)
    {
        $rating = $request->input('rating');
        $content = $request->input('desc');
        $ownerUsername = $request->route('id');
        $idowner = User::where('username',$ownerUsername)->first()->idclient;

        if (Auth::check()) {
            if (Auth::user()->idclient === $idowner) {
                return redirect()->back()->withErrors(['error' => 'Cannot Review Yourself']);
            }
        } elseif (Auth::guard('admin')->check()) {
            return redirect()->back()->withErrors(['error' => 'An admin cannot review anyone']);
        } elseif (!Auth::check()) {
            return redirect()->back()->withErrors(['error' => 'Need to login first!']);
        }

        $user = Auth::user()->idclient;

        // falta distinguir se ganhou ou nao a auction


        $review = new Review();
        $review->reviewdate = now();
        $review->comment = $content;
        $review->rating = $rating;
        $review->iduserreviewed = $idowner;
        $review->iduserreviewer = $user;

        $review->save();

        return redirect()->back();
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
        //
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

