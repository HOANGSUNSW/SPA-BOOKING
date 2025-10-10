<?php

namespace Database\Seeders;

use App\Models\Users;
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

        Users::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'=>'123456',
            'phone'=>'09112123456',
            'role'=>'123456',
        ]);
    }
}
