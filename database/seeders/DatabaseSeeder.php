<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Customer1',
            'email' => 'customer1@customer.com',
            'password' => bcrypt('Password!'),
        ]);

        User::factory()->create([
            'name' => 'Customer2',
            'email' => 'customer2@customer.com',
            'password' => bcrypt('Password!'),
        ]);

        User::factory()->create([
            'name' => 'Customer2',
            'email' => 'customer2@partner.com',
            'password' => bcrypt('Password!'),
        ]);

        User::factory()->create([
            'name' => 'NGO',
            'email' => 'ngo@ngo.com',

        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Password!'),
        ]);
    }
}
