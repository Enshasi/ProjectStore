<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Category;
use App\Models\product;
use App\Models\Store;
use Database\Factories\AdminFactory;
use Illuminate\Database\Seeder;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\Admin::factory()->create([
            'password' => Hash::make('12345678'),
            'email' => 'harry@den.com',
        ]);
        \App\Models\User::factory()->create([
            'password' => Hash::make('password'),
            'email' => 'Abd2@mailinator.com',
        ]);
        // Store::factory(5)->create();
        // Category::factory(10)->create();
        // product::factory(100)->create();
        // Admin::factory(3)->create();
        // $this->call(UserSeeder::class);
    }
}
