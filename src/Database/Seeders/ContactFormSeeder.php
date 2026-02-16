<?php

namespace Trippledee\ContactForm\Database\Seeders;

use Illuminate\Database\Seeder;
use Trippledee\ContactForm\Models\User;
use Illuminate\Support\Facades\Hash;

class ContactFormSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
    }
}
