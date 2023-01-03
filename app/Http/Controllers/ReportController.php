<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionReport;
use App\Models\Bid;
use App\Models\SellerReport;
use App\Models\SystemManagerLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
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
    public function createSellerReport(Request $request)
    {
        $content = $request->input('desc');
        $ownerUsername = $request->route('id');
        $idowner = User::where('username',$ownerUsername)->first()->idclient;
        
        if (Auth::check()) {
            if (Auth::user()->idclient === $idowner) {
                return redirect()->back()->withErrors(['error' => 'Cannot Report Yourself']);
            }
        } elseif (Auth::guard('admin')->check()) {
            return redirect()->back()->withErrors(['error' => 'An admin cannot report users']);
        } elseif (!Auth::check()) {
            return redirect()->back()->withErrors(['error' => 'Need to login first!']);
        }
        //$this->authorize("create",SellerReport::class);
        $content = $request->input('desc');
        $ownerUsername = $request->route('id');
        $idowner = User::where('username',$ownerUsername)->first()->idclient;
        $user = Auth::user()->idclient;

        // falta distinguir se ganhou ou nao a auction

        

        $user = Auth::user()->idclient;

        // falta distinguir se ganhou ou nao a auction


        $report = new SellerReport();
        $report->reportdate = now();
        $report->description = $content;
        $report->issolved = false;
        $report->idseller = $idowner;
        $report->idreporter = $user;

        $report->save();

        return redirect()->back();
    }

    public function createAuctionReport(Request $request)
    {
        $content = $request->input('desc');
        $idauction = $request->route('id');
        $idowner = Auction::where('idauction',$idauction)->first()->idowner;

        if (Auth::check()) {
            if (Auth::user()->idclient === $idowner) {
                return redirect()->back()->withErrors(['error' => 'Cannot Report Your Own Auction']);
            }
        } elseif (Auth::guard('admin')->check()) {
            return redirect()->back()->withErrors(['error' => 'An admin cannot report auctions']);
        } elseif (!Auth::check()) {
            return redirect()->back()->withErrors(['error' => 'Need to login first!']);
        }
        $user = Auth::user()->idclient;

        // falta distinguir se ganhou ou nao a auction


        $report = new AuctionReport();
        $report->reportdate = now();
        $report->description = $content;
        $report->issolved = false;
        $report->idauction = $idauction;
        $report->idreporter = $user;

        $report->save();

        return redirect()->back();
    }

    public function changeStatus($id) {
        //$this->authorize('update',SellerReport::class);
        if(!Auth::guard('admin')->check()){
            return redirect()->back()->withErrors(['Not an ADMIN!']);
        }
        $report = SellerReport::find($id);
        if($report->issolved) {
            $report->update(['issolved' => "0"]);
            SystemManagerLog::create([
                'idsysman' => Auth::guard('admin')->id(),
                'logdescription' => 'UnResolved report id: ' . $id,
                'logdate' => date('Y-m-d H:i:s'),
                'logtype' => 'Update Report',
            ]);
        }
        else {
            $report->update(['issolved' => "1"]);
            SystemManagerLog::create([
                'idsysman' => Auth::guard('admin')->id(),
                'logdescription' => 'Resolved report id: ' . $id,
                'logdate' => date('Y-m-d H:i:s'),
                'logtype' => 'Update Report',
            ]);
        }

        return redirect()->back();
    }

    public function changeStatus2($id) {
        if(!Auth::guard('admin')->check()){
            return redirect()->back()->withErrors(['Not an ADMIN!']);
        }
        //$this->authorize('update',AuctionReport::class);
        $report = AuctionReport::find($id);
        if($report->issolved) {
            $report->update(['issolved' => "0"]);
            SystemManagerLog::create([
                'idsysman' => Auth::guard('admin')->id(),
                'logdescription' => 'UnResolved report id: ' . $id,
                'logdate' => date('Y-m-d H:i:s'),
                'logtype' => 'Update Report',
            ]);
        }
        else {
            $report->update(['issolved' => "1"]);
            SystemManagerLog::create([
                'idsysman' => Auth::guard('admin')->id(),
                'logdescription' => 'Resolved report id: ' . $id,
                'logdate' => date('Y-m-d H:i:s'),
                'logtype' => 'Update Report',
            ]);
        }

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

