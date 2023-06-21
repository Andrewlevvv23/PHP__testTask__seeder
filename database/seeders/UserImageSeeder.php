<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserImage;
use Faker\Factory as Faker;

class UserImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 10; $i++) {
                UserImage::create([
                    'image' => $faker->imageUrl(),
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
