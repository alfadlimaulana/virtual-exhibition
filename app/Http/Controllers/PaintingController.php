<?php

namespace App\Http\Controllers;

use App\Models\Painting;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use App\Models\PaintingImage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePaintingRequest;

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
        return view('dashboard.add', [
            "title" => "Tambah Lukisan",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaintingRequest $request)
    {
        $validated = $request->validated();

        $validated['dimension'] = $validated['height'] . ' x ' . $validated['width'];
        $validated['user_id'] = $request->user()->id;

        $images = [];
        foreach ($request->file('images') as $image) {
            // $path = FileTrait::store_file(null, $image['image'], 'love_stories');
            $dir_image = $image->store('img/painting-images', 'public');
            $images[] = $dir_image;
        }

        unset($validated['height'], $validated['width'], $validated['images']);
        $painting = Painting::create($validated);

        foreach ($images as $image) {
            $image = PaintingImage::create([
                'image' => $image,
                'painting_id' => $painting->id
            ]);
        }
        
        return redirect()->route('dashboard.paintings')->with('success', 'Lukisan berhasil ditambahkan dan akan ditinjau oleh kurator.');
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
        $paintings = Painting::where('user_id', auth()->user()->id)->with(['likedPaintings'])->filter($request->query())->latest()->paginate(8);

        return view('dashboard.index', [
            "title" => "Dashboard",
            "paintings" => $paintings,
        ]);
    }
}
