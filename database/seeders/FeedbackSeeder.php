<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Feedback;
use App\Models\Painting;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paintings = Painting::where('status', 'rejected')->get();
        $users = User::where('role', 'kurator')->get();

        foreach ($paintings as $painting) {
            Feedback::create([
                'id' => Str::uuid(),
                'user_id' => $users->random()->id,
                'painting_id' => $painting->id,
                'message' => "Kualitas gambar kurang baik, tolong upload kembali.",
            ]);
        }
    }
}
