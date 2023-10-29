<?php

namespace App\Http\Controllers;

use App\Models\Painting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $title = "Home";

        $paintings = Painting::with('paintingImages')->paginate(12);
        // dd($paintings[0]);

        return view('home.index', compact('title', 'paintings'));
    }
}
