<?php

namespace App\Http\Controllers;

use App\Models\Painting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $title = "Home";
        $query = Painting::latest();

        if($request->query('keyword')){
            $keyword = $request->query('keyword');
            $query->where('title', 'like', '%'.$keyword. '%');
        };

        $paintings = $query->paginate(12);
        $paintings->appends([
            'keyword' => $keyword ?? null,
        ]);

        return view('home.index', compact('title', 'paintings'));
    }
}
