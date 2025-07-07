<?php

namespace Database\Seeders;
use App\Models\DiningTable;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiningTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            DiningTable::create([
                'table_number' => 'Table ' . $i,
                'status' => 'Available',
                'created_at' => now(), 
                'updated_at' => now()
            ]);
        }

        // Create 5 occupied tables
        for ($i = 6; $i <= 10; $i++) {
            DiningTable::create([
                'table_number' => 'Table ' . $i,
                'status' => 'Occupied',
                'created_at' => now(), 
                'updated_at' => now()
            ]);
        }
    }
}
