<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class PaisSeeder extends Seeder
{
    public function run(): void
    {
        $paises = [
            'Ecuador', 'Perú', 'Colombia', 'Bolivia', 'Brasil', 'Venezuela', 'Guayana Francesa', 'Surinam', 'Guyana'
        ];

        foreach ($paises as $pais) {
            DB::table('paises')->insert([
                'nombre' => $pais,
                'slug' => Str::slug($pais),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
