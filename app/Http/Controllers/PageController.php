<?php

namespace App\Http\Controllers;

use App\Models\Painting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        return view('home.index', [
            "title" => "Home",
            "paintings" => Painting::with(['paintingImages', 'user'])->filter($request->query())->paginate(1)
                            ->appends(
                                [
                                    'keyword' => $request->query('keyword') ?? null,
                                    'category' => $request->query('category') ?? null,
                                    'material' => $request->query('material') ?? null,
                                ]),
        ]);
    }
}
