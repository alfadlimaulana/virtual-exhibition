<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Painting;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaintingCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paintings = Painting::all();
        $categories = Category::all();

        foreach ($paintings as $painting) {
            DB::table('painting_categories')->insert([
                'id' => Str::uuid(),
                'painting_id' => $painting->id,
                'category_id' => $categories->random()->id,
            ]);

            DB::table('painting_categories')->insert([
                'id' => Str::uuid(),
                'painting_id' => $painting->id,
                'category_id' => $categories->random()->id,
            ]);
        }
    }
}
