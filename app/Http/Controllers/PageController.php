<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Menampilkan halaman expired apabila masa langganan telah habis
     */
    public function expired()
    {
        return view('expired', [
            "title" => "Subscription Expired",
        ]);
    }
}
