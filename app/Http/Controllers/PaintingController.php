<?php

namespace App\Http\Controllers;

use App\Models\Painting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaintingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paintings = Painting::with(['paintingImages', 'user'])->filter($request->query())->paginate(9);
        $paintings->appends([
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

    /**
     * Show the  form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Painting $painting)
    {
        if(Auth::check()){
            $liked = $painting->likedPaintings->where('user_id', '=', auth()->user()->id)->count() > 0;
        }

        return view('detail', [
            "title" => "Painting Detail",
            "painting" => $painting,
            "liked" => $liked ?? false
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Painting $painting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Painting $painting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Painting $painting)
    {
        //
    }

    public function userPaintings(Request $request)
    {
        $paintings = Painting::where('user_id', auth()->user()->id)->filter($request->query())->paginate(8);

        return view('dashboard.index', [
            "title" => "Dashboard",
            "paintings" => $paintings,
        ]);
    }
}
