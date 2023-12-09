<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Painting;
use App\Models\LikedPainting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaintingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'alfadli@gmail.com')->first();
        $status = ['on display', 'on review', 'on review'];

        for ($i = 0; $i < 3; $i++) {
            Painting::factory()->state([
                'title' => 'Painting '.($i+1),
                'status' => $status[$i],
                'user_id' => $user->id
            ])->create();
        }
    }
}
