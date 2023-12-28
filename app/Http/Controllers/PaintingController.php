<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Painting;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use App\Models\PaintingImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePaintingRequest;
use App\Http\Requests\UpdatePaintingRequest;

class PaintingController extends Controller
{
    /**
     * Menampilkan lukisan di halaman beranda.
     */
    public function index(Request $request)
    {
        $paintings = Painting::with(['paintingImages', 'user'])->where('status', 'on display')->filter($request->query())->paginate(9);
        $paintings->appends([
            'keyword' => $request->query('keyword') ?? null,
            'liked' => $request->query('liked') ?? null,
            'category' => $request->query('category') ?? null,
            'material' => $request->query('material') ?? null,
        ]);

        return view('home.index', [
            "title" => "Home",
            "paintings" => $paintings,
            "provinces" => User::getProvinceOptions(),
        ]);
    }

    /**
     * Menampilkan form untuk menambahkan lukisan
     */
    public function create()
    {
        return view('dashboard.add', [
            "title" => "Tambah Lukisan",
        ]);
    }

    /**
     * Menyimpan data lukisan yang baru ditambahkan
     */
    public function store(StorePaintingRequest $request)
    {
        $validated = $request->validated();

        $validated['dimension'] = $validated['height'] . ' X ' . $validated['width'];
        $validated['user_id'] = $request->user()->id;

        $images = [];
        foreach ($request->file('images') as $image) {
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
     * Menampilkan informasi detil suatu lukisan
     */
    public function show(Painting $painting)
    {
        if(Auth::check()){
            $liked = $painting->likedPaintings->where('user_id', '=', auth()->user()->id)->count() > 0;
        }

        return view('detail', [
            "title" => "Detil Painting",
            "painting" => $painting,
            "liked" => $liked ?? false
        ]);
    }

    /**
     * Menampilkan form untuk mengubah data lukisan
     */
    public function edit(Painting $painting)
    {
        return view('dashboard.edit', [
            "title" => "Edit Lukisan",
            "painting" => $painting,
        ]);
    }

    /**
     * Menyimpan data lukisan yang diperbaharui
     */
    public function update(UpdatePaintingRequest $request, Painting $painting)
    {
        $validated = $request->except('_token');

        $validated['dimension'] = $validated['height'] . ' X ' . $validated['width'];
        unset($validated['height'], $validated['width'], $validated['images']);
        
        $images = [];
        $old_images = $painting->paintingImages->pluck('image')->toArray();
        if($request->file('images')){
            $painting->paintingImages()->delete();
            Storage::disk('public')->delete($old_images);
            
            foreach ($request->file('images') as $image) {
                $dir_image = $image->store('img/painting-images', 'public');
                $images[] = $dir_image;
            }
        }
        $validated['status'] = 'on review';
        
        $painting->update($validated);
        foreach ($images as $image) {
            $image = PaintingImage::create([
                'image' => $image,
                'painting_id' => $painting->id
            ]);
        }

        return redirect()->route('dashboard.paintings')->with('success', 'Lukisan berhasil diubah');
    }

    /**
     * Menghapus lukisan tertentu
     */
    public function destroy(Painting $painting)
    {
        $painting->paintingImages()->delete();
        $painting->delete();
        return redirect()->route('dashboard.paintings')->with('success', 'Lukisan berhasil dihapus');
    }

    /**
     * Mengampilkan daftar lukisan milik pengguna yang terautentikasi
     */
    public function userPaintings(Request $request)
    {
        $paintings = Painting::where('user_id', auth()->user()->id)->withCount('likedPaintings')->filter($request->query())->latest()->paginate(8);
        $paintings->appends(
        [
            'keyword' => $request->query('keyword') ?? null,
        ]);

        return view('dashboard.index', [
            "title" => "Dashboard",
            "paintings" => $paintings,
        ]);
    }
}
