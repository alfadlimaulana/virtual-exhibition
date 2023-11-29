<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use App\Models\Painting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaintingController extends Controller
{
    public function index(Request $request)
    {
        $paintings = Painting::where('status', 'on review')->filter($request->query())->oldest()->paginate(8);

        return view('dashboard.kurator.index', [
            "title" => "Dashboard Kurator",
            "paintings" => $paintings,
        ]);
    }

    public function show(Painting $painting)
    {
        return view('dashboard.kurator.detail', [
            "title" => "Detil Painting",
            "painting" => $painting,
        ]);
    }

    public function approve(Painting $painting)
    {
        $painting->update(["status"=> "on display"]);
        return redirect()->route('dashboard.kurator.paintings')->with('success', 'Lukisan telah disetujui');
    }

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