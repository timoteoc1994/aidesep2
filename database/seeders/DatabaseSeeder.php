<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 👉 Semillas para estructura base del sistema
        $this->call([
            RoleSeeder::class,
            CategoriaSeeder::class,
            PaisSeeder::class,
            ProvinciaSeeder::class,
        ]);

        // 👉 Usuario de prueba
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => 1, // Asegúrate de que el rol SuperAdmin tenga ID = 1
        ]);
    }
}
