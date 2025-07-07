<?php

namespace Database\Seeders;
use App\Models\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Cappuccino',
                'description' => 'Hot espresso with steamed milk',
                'price' => 8.50,
                'image' => 'images/wenhao-ruan-tPHZoqLkVw8-unsplash.jpg',
                'category_id' => 1,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Iced Lemon Tea',
                'description' => 'Refreshing iced tea with lemon',
                'price' => 6.00,
                'image' => 'images/yeoul-shin-XAM9egfBilk-unsplash.jpg',
                'category_id' => 1,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Chicken Sandwich',
                'description' => 'Grilled chicken with mayo in bread',
                'price' => 10.00,
                'image' => 'images/say-s-3IHKG-iqAmc-unsplash.jpg',
                'category_id' => 2,
                'created_at' => now(), 
                'updated_at' => now()
            ],

            // 10 new products
            [
                'name' => 'Espresso',
                'description' => 'Strong black coffee',
                'price' => 7.00,
                'image' => 'images/adi-goldstein-xKS-1DP4g7A-unsplash.jpg',
                'category_id' => 1,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Latte',
                'description' => 'Coffee with steamed milk',
                'price' => 9.00,
                'image' => 'images/tabitha-turner-3n3mPoGko8g-unsplash.jpg',
                'category_id' => 1,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Mocha',
                'description' => 'Coffee with chocolate and milk',
                'price' => 9.50,
                'image' => 'images/zoe-gXtvTOs4tzg-unsplash.jpg',
                'category_id' => 1,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Green Tea',
                'description' => 'Traditional Japanese tea',
                'price' => 5.50,
                'image' => 'images/jason-leung-Z-hvocTfR_s-unsplash.jpg',
                'category_id' => 1,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Beef Burger',
                'description' => 'Juicy beef patty with fresh veggies',
                'price' => 12.50,
                'image' => 'images/amirali-mirhashemian-sc5sTPMrVfk-unsplash.jpg',
                'category_id' => 2,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Caesar Salad',
                'description' => 'Fresh greens with Caesar dressing',
                'price' => 9.50,
                'image' => 'images/raphael-nogueira-63mHpYEyjCA-unsplash.jpg',
                'category_id' => 2,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Chocolate Cake',
                'description' => 'Rich chocolate dessert',
                'price' => 7.00,
                'image' => 'images/pushpak-dsilva-2UeBOL7UD34-unsplash.jpg',
                'category_id' => 2,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Cheesecake',
                'description' => 'Creamy New York style cheesecake',
                'price' => 8.00,
                'image' => 'images/orkun-orcan-7yhu6txevQA-unsplash.jpg',
                'category_id' => 2,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Mineral Water',
                'description' => '500ml bottled water',
                'price' => 3.00,
                'image' => 'images/visual-karsa-pMds28MM7js-unsplash.jpg',
                'category_id' => 1,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'name' => 'Fruit Juice',
                'description' => 'Freshly squeezed orange juice',
                'price' => 6.50,
                'image' => 'images/fotografia-de-alimentos-ep1d3v8CwAY-unsplash.jpg',
                'category_id' => 1,
                'created_at' => now(), 
                'updated_at' => now()
            ]
        ]);
    }
}
