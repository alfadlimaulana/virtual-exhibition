<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(7)
                ->sequence(
                    ['name' => 'realism'],
                    ['name' => 'photorealism'],
                    ['name' => 'expressionism'],
                    ['name' => 'impressionism'],
                    ['name' => 'abstract'],
                    ['name' => 'surrealism'],
                    ['name' => 'pop art'],
                )
                ->create();
    }
}
