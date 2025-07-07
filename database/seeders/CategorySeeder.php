<?php

namespace Database\Seeders;
use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Drinks', 'description' => 'Hot and cold beverages', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Foods', 'description' => 'Snacks and meals', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
