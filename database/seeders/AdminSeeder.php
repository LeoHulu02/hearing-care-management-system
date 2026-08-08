<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@hearingcare.test'],
            [
                'name' => 'Administrator',
                'phone' => '081234567890',
                'role' => User::ROLE_ADMIN,
                'password' => Hash::make('Admin#12345'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@hearingcare.test'],
            [
                'name' => 'Customer Demo',
                'phone' => '081298765432',
                'role' => User::ROLE_CUSTOMER,
                'password' => Hash::make('Customer#12345'),
            ]
        );

        // Tambahan akun permanen
        User::updateOrCreate(
            ['email' => 'admin2@hearingcare.test'],
            [
                'name' => 'Administrator 2',
                'phone' => '081111111111',
                'role' => User::ROLE_ADMIN,
                'password' => Hash::make('Admin#12345'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'budi@hearingcare.test'],
            [
                'name' => 'Budi Santoso',
                'phone' => '082222222222',
                'role' => User::ROLE_CUSTOMER,
                'password' => Hash::make('Customer#12345'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'siti@hearingcare.test'],
            [
                'name' => 'Siti Aminah',
                'phone' => '083333333333',
                'role' => User::ROLE_CUSTOMER,
                'password' => Hash::make('Customer#12345'),
            ]
        );
    }
}
