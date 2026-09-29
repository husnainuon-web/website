<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);

        $customer = User::firstOrCreate(
            ['email' => 'customer@gmail.com'],
            [
                'name' => 'Customer User',
                'password' => Hash::make('Customer@12345'),
                'role' => 'customer',
            ]
        );

        $industrial = Category::firstOrCreate(
            ['name' => 'Industrial Tools'],
            [
                'description' => 'High-quality industrial equipment for everyday business use.',
                'status' => true,
            ]
        );

        $safety = Category::firstOrCreate(
            ['name' => 'Safety Gear'],
            [
                'description' => 'Reliable personal protective equipment for all work environments.',
                'status' => true,
            ]
        );

        $products = [
            [
                'category_id' => $industrial->id,
                'name' => 'Heavy Duty Drill',
                'sku' => 'HDR-1001',
                'description' => 'A powerful drill designed for construction, maintenance, and workshop tasks.',
                'price' => 2199.00,
                'stock' => 14,
                'main_image' => null,
                'specifications' => ['Power' => '850W', 'Type' => 'Corded'],
                'tags' => ['drill', 'industrial', 'featured'],
                'status' => true,
            ],
            [
                'category_id' => $industrial->id,
                'name' => 'Precision Angle Grinder',
                'sku' => 'PAG-2002',
                'description' => 'Compact grinder with accurate cutting and polishing performance.',
                'price' => 1899.00,
                'stock' => 9,
                'main_image' => null,
                'specifications' => ['Power' => '750W', 'Disc Size' => '4 inch'],
                'tags' => ['grinder', 'precision', 'metalwork'],
                'status' => true,
            ],
            [
                'category_id' => $safety->id,
                'name' => 'Protective Safety Helmet',
                'sku' => 'PSH-3003',
                'description' => 'Impact-resistant helmet built for safety-focused environments.',
                'price' => 1499.00,
                'stock' => 22,
                'main_image' => null,
                'specifications' => ['Material' => 'ABS Plastic', 'Standards' => 'ANSI Certified'],
                'tags' => ['helmet', 'safety'],
                'status' => true,
            ],
        ];

        foreach ($products as $product) {
            $product['slug'] = Str::slug($product['name']);

            Product::updateOrCreate(
                ['sku' => $product['sku']],
                $product
            );
        }

        $sampleProduct = Product::where('sku', 'HDR-1001')->first();

        if ($sampleProduct) {
            Wishlist::firstOrCreate([
                'user_id' => $customer->id,
                'product_id' => $sampleProduct->id,
            ]);
        }
    }
}
