<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function faqs(){
        $faqs = ["What is WeBid?",
            "How do I participate in an auction?",];
        return view('pages.faq',['faqs' => $faqs]);
    }

    public function faq(){
        $faqs = ["What is WeBid?",
            "How do I participate in an auction?",];
        return view('pages.edit',['faqs' => $faqs]);
    }
}
