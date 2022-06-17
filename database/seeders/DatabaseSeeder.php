<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        // \App\Models\Category::factory(5)->create();
        DB::table('categories')->insert([
            ['name' => 'Màn hình'],
            ['name' => 'Chuột'],
            ['name' => 'Laptop'],
            ['name' => 'UPS'],
            ['name' => 'Tai nghe']
        ]);

        \App\Models\Equipment::factory(100)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
