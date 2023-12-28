<?php

namespace App\Http\Controllers;

use App\Models\LikedPainting;
use Illuminate\Http\Request;

class LikedPaintingController extends Controller
{
    /**
     * Menyimpan data lukisan yang disukai (menyukai lukisan)
     */
    public function store(Request $request, string $id)
    {
        $liked_painting = LikedPainting::create([
            'user_id' => auth()->user()->id,
            'painting_id' => $id
        ]);

        if(!$liked_painting) {
            return back()->withErrors(['failed' => 'Gagal menyukai lukisan']);
        }
        
        return back();
    }

    /**
     * Menghapus data lukisan yang disukai (berhenti menyukai)
     */
    public function destroy(string $id)
    {
        $liked_painting = LikedPainting::where('user_id', '=', auth()->user()->id)->where('painting_id', '=', $id)->delete();
        
        if(!$liked_painting) {
            return back()->withErrors(['failed' => 'Gagal berhenti menyukai lukisan']);
        }
        
        return back();

    }
}
