<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(30)->create();
        DB::table('users')->insert([
            'name' => 'Kiet',
            'gender' => true,
            'birthdate' => '2000/07/05',
            'email' => 'kiet@gmail.com',
            'password' => Hash::make('123456'),
            'is_admin' => true
        ]);

        DB::table('users')->insert([
            'name' => 'Hoang Anh',
            'gender' => true,
            'birthdate' => '1990/07/05',
            'email' => 'anh@gmail.com',
            'password' => Hash::make('123456'),
            'is_admin' => true
        ]);
        // \App\Models\Category::factory(5)->create();
        DB::table('categories')->insert([
            ['name' => 'Monitor'],
            ['name' => 'Mouse'],
            ['name' => 'Laptop'],
            ['name' => 'UPS'],
            ['name' => 'Headset']
        ]);

        \App\Models\Equipment::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
