<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        Product::upsert(
            [
                [
                    'name' => 'HearClear Basic BTE',
                    'image' => null,
                    'price' => 3500000,
                    'stock' => 25,
                    'description' => 'Behind-the-ear hearing aid for mild hearing loss.',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'HearClear Pro RIC',
                    'image' => null,
                    'price' => 7200000,
                    'stock' => 15,
                    'description' => 'Receiver-in-canal device with adaptive noise reduction.',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'HearClear Premium ITC',
                    'image' => null,
                    'price' => 9800000,
                    'stock' => 10,
                    'description' => 'In-the-canal model with premium sound personalization.',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ],
            ['name'],
            ['image', 'price', 'stock', 'description', 'updated_at']
        );
    }
}
