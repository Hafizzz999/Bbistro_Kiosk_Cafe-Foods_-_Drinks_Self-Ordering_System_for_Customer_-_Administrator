<?php

namespace Database\Seeders;
use App\Models\Order;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'dining_method' => 'Eat In',
            'dining_table_id' => 1,
            'total_price' => 24.50,
            'payment_method' => 'Cash',
            'status' => 'Completed',
            'created_at' => now(), 
            'updated_at' => now(),
        ]);

        Order::create([
            'dining_method' => 'Take Away',
            'dining_table_id' => null,
            'total_price' => 14.00,
            'payment_method' => 'QR Pay',
            'status' => 'Pending',
            'created_at' => now(), 
            'updated_at' => now(),
        ]);

        // 10 new orders
        for ($i = 1; $i <= 10; $i++) {
            $method = $i % 2 == 0 ? 'Eat In' : 'Take Away';
            $statuses = ['Pending', 'Completed'];
            $payments = ['Cash', 'QR Pay', 'Debit/Credit Card'];
            
            Order::create([
                'dining_method' => $method,
                'dining_table_id' => $method === 'Eat In' ? rand(1, 10) : null,
                'total_price' => rand(1000, 5000) / 100, // Random price between 10.00-50.00
                'payment_method' => $payments[array_rand($payments)],
                'status' => $statuses[array_rand($statuses)],
                'created_at' => now()->subDays(rand(1, 30)), 
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
