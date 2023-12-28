<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use App\Models\Painting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaintingController extends Controller
{
    /**
     * Mengampilkan daftar lukisan yang perlu ditinjau
     */
    public function index(Request $request)
    {
        if ($request->query('status') == 'display') {
            $paintings = Painting::where('status', 'on display')->filter($request->query())->latest('updated_at')->paginate(8);
        } else {
            $paintings = Painting::where('status', 'on review')->filter($request->query())->oldest('updated_at')->paginate(8);
        }

        $paintings->appends(
        [
            'status' => $request->query('status') ?? null,
            'keyword' => $request->query('keyword') ?? null,
        ]);

        return view('dashboard.kurator.index', [
            "title" => "Dashboard Kurator",
            "paintings" => $paintings,
        ]);
    }

    /**
     * Mengampilkan detil lukisan
     */
    public function show(Painting $painting)
    {
        return view('dashboard.kurator.detail', [
            "title" => "Detil Painting",
            "painting" => $painting,
        ]);
    }

    /**
     * Menyetujui lukisan untuk ditampilkan
     */
    public function approve(Painting $painting)
    {
        $painting->update(["status"=> "on display"]);
        return redirect()->route('dashboard.kurator.paintings')->with('success', 'Lukisan telah disetujui');
    }

    /**
     * Menolak lukisan untuk ditampilkan
     */
    public function reject(Request $request, Painting $painting)
    {
        $painting->update(["status" => "rejected"]);
        $painting->feedbacks()->create([
            "message" => $request->input('message'),
            'user_id' => $request->user()->id
        ]);

        return redirect()->route('dashboard.kurator.paintings')->with('success', 'Lukisan telah ditolak');
    }
}
