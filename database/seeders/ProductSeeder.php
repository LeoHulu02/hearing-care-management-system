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
                [
                    'name' => 'Audiva Invisible IIC',
                    'image' => null,
                    'price' => 12500000,
                    'stock' => 8,
                    'description' => 'Ultra-discreet invisible-in-canal hearing aid. Custom molded to fit perfectly inside your ear canal.',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'SonicBoost Recharge BTE',
                    'image' => null,
                    'price' => 8500000,
                    'stock' => 20,
                    'description' => 'Rechargeable Behind-The-Ear model. Up to 24 hours of battery life on a single charge.',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'Connect Max RIC (Bluetooth)',
                    'image' => null,
                    'price' => 11000000,
                    'stock' => 12,
                    'description' => 'Receiver-In-Canal with direct Bluetooth connectivity to smartphones and TVs.',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'ClearTone Pediatric BTE',
                    'image' => null,
                    'price' => 5500000,
                    'stock' => 5,
                    'description' => 'Specially designed Behind-The-Ear hearing aid for children with secure battery doors and robust casing.',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'EcoHear Value CIC',
                    'image' => null,
                    'price' => 4200000,
                    'stock' => 30,
                    'description' => 'Completely-In-Canal entry-level hearing aid offering great value and decent sound clarity.',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'AquaShield Waterproof BTE',
                    'image' => null,
                    'price' => 14000000,
                    'stock' => 7,
                    'description' => 'IP68 rated waterproof hearing aid for active lifestyles. Perfect for sports and humid environments.',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'HearSense AI Pro',
                    'image' => null,
                    'price' => 18500000,
                    'stock' => 4,
                    'description' => 'Alat bantu dengar dengan kecerdasan buatan (AI) yang dapat beradaptasi secara otomatis dengan lingkungan sekitar Anda.',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'ClearVoice Tinnitus Masker',
                    'image' => null,
                    'price' => 9200000,
                    'stock' => 11,
                    'description' => 'Alat bantu dengar yang dilengkapi fitur khusus untuk meredam dan mengurangi dengingan pada telinga (tinnitus).',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'name' => 'Zenith Power BTE SP',
                    'image' => null,
                    'price' => 16000000,
                    'stock' => 9,
                    'description' => 'Super Power BTE untuk gangguan pendengaran sangat berat. Menghasilkan amplifikasi maksimal tanpa distorsi.',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            ],
            ['name'],
            ['image', 'price', 'stock', 'description', 'updated_at']
        );
    }
}
