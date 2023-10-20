<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Payment;
use App\Models\Painting;
use Illuminate\Support\Str;
use App\Models\Subscription;
use App\Models\PaintingImage;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        User::factory()->state([
                'name' => 'Pengunjung',
                'email' => 'pengunjung@gmail.com',
            ])->has(Subscription::factory()->none())->create();

        User::factory()->pelukis()->state([
                'name' => 'Alfadli Maulana Siddik',
                'email' => 'alfadli@gmail.com',
            ])
            ->has(Payment::factory()->paid())
            ->has(Subscription::factory()->active())
            ->has(Painting::factory()->count(5))
            ->create();

        User::factory()->pelukis()->count(2)
            ->hasPayments()
            ->has(Subscription::factory()->state(function (array $attributes, User $user) {
                if($user->payments[0]->status == 'unpaid') {
                    return ['expired_date' => null]; 
                }
                else {
                    return [];
                };
            }))
            ->sequence(
                ['name' => 'Pelukis 1'],
                ['name' => 'Pelukis 2']
            )
            ->has(Painting::factory()->count(5)
                    ->has(PaintingImage::factory()->count(3)
                    ->sequence(
                        fn (Sequence $sequence) => ['image' => 'img/painting-images/'.$sequence->index.'.jpg']
                    ))
                )
            ->create();

        User::factory()->kurator()->state([
                'name' => 'Kurator',
                'email' => 'kurator@gmail.com',
            ])->create();
    }
}
