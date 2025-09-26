<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class ProvinciaSeeder extends Seeder
{
    public function run(): void
    {
        $ecuadorId = DB::table('paises')->where('slug', 'ecuador')->value('id');

        $provincias = [
            'Sucumbíos', 'Napo', 'Orellana', 'Pastaza', 'Morona Santiago', 'Zamora Chinchipe'
        ];

        foreach ($provincias as $provincia) {
            DB::table('provincias')->insert([
                'nombre' => $provincia,
                'slug' => Str::slug($provincia),
                'pais_id' => $ecuadorId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

