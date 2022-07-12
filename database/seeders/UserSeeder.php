<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        // DB::table('users')->truncate();
        $superadmin = User::create([
            'firstname'         => 'ahmed',
            'lastname'          => 'ragab',
            'phone'             => '01021493036',
            'email'             => 'super@app.com',
            'password'          => bcrypt('123123'),
            'image'             => 'avatar.svg',
            'status'            => 1,
            'remember_token'     => Str::random(10),
            'email_verified_at' => now(),
        ]);
        $superadmin->attachRole('super_admin');

        $admin = User::create([
            'firstname'         => 'yasin',
            'lastname'          => 'ahmed',
            'phone'             => '01000000000',
            'email'             => 'admin@app.com',
            'password'          => bcrypt('123123'),
            'image'             => 'avatar.svg',
            'status'            => 1,
            'remember_token'     => Str::random(10),
            'email_verified_at' => now(),
        ]);
        $admin->attachRole('admin');
        $user = User::create([
            'firstname'         => 'sara',
            'lastname'          => 'ahmed',
            'phone'             => '01000000005',
            'email'             => 'user@app.com',
            'password'          => bcrypt('123123'),
            'image'             => 'avatar.svg',
            'status'            => 1,
            'remember_token'     => Str::random(10),
            'email_verified_at' => now(),
        ]);
        $user->attachRole('user');

        for ($i = 1; $i <= 20; $i++) {
            $random_user = User::create([
                'firstname'         => $faker->firstname,
                'lastname'          => $faker->lastname,
                'phone'             => '010' . $faker->numberBetween(10000000, 99999999),
                'email'             => $faker->unique()->safeEmail,
                'password'          => bcrypt('123123'),
                'image'             => rand(1,7).'.jpg',
                'status'            => 1,
                'remember_token'     => Str::random(10),
                'email_verified_at' => now(),
            ]);
            $random_user->attachRole('user');
        }
    }
}
