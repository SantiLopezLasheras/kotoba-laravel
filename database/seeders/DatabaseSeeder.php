<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Admin1234!'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'lasheras',
            'email' => 'lasheras@test.com',
            'password' => Hash::make('user1234'),
        ]);

        User::factory()->create([
            'name' => 'santiago',
            'email' => 'santiago@test.com',
            'password' => Hash::make('user1234'),
        ]);


        User::factory()->create([
            'name' => 'Jorge',
            'email' => 'jorge@test.com',
            'password' => Hash::make('user1234'),
        ]);


        User::factory()->create([
            'name' => 'lopez',
            'email' => 'lopez@test.com',
            'password' => Hash::make('user1234'),
        ]);


        $this->call(ListaSeeder::class);
        $this->call(FlashcardSeeder::class);
    }
}
