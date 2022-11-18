<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin(){
        $alo = ["alo"];
        return view('pages.adminpanel',['alo' => $alo]);
    }
}
