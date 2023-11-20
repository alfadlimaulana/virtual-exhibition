<?php

namespace App\Http\Controllers;

use App\Models\Painting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function artistDashboard(Request $request)
    {
        $paintings = Painting::with(['paintingImages', 'user'])->filter($request->query())->paginate(9);
        $paintings->appends(
            [
                'keyword' => $request->query('keyword') ?? null,
                'liked' => $request->query('liked') ?? null,
                'category' => $request->query('category') ?? null,
                'material' => $request->query('material') ?? null,
            ]);

        return view('home.index', [
            "title" => "Home",
            "paintings" => $paintings,
        ]);
    }

    public function expired()
    {
        return view('expired', [
            "title" => "Subscription Expired",
        ]);
    }
}
