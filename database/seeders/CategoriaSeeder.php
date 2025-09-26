<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categorias')->insert([
            [
                'nombre' => 'Bisutería',
                'slug' => Str::slug('Bisutería'),
                'imagen' => '/images/amazonFairTrade/Bisuteria.webp',
                'descripcion' => 'Joyería elaborada a mano con semillas, fibras naturales y técnicas tradicionales'
            ],
            [
                'nombre' => 'Moda Sostenible',
                'slug' => Str::slug('Moda Sostenible'),
                'imagen' => '/images/amazonFairTrade/Moda.webp',
                'descripcion' => 'Prendas confeccionadas con algodón orgánico y tintes naturales por artesanos indígenas'
            ],
            [
                'nombre' => 'Artesanía',
                'slug' => Str::slug('Artesanía'),
                'imagen' => '/images/amazonFairTrade/Artesania.webp',
                'descripcion' => 'Obras de arte tradicionales que expresan la cosmovisión y cultura amazónica'
            ],
            [
                'nombre' => 'Turismo',
                'slug' => Str::slug('Turismo'),
                'imagen' => '/images/amazonFairTrade/Turismo.webp',
                'descripcion' => 'Experiencias inmersivas guiadas por miembros de las comunidades locales'
            ],
            [
                'nombre' => 'Gastronomía',
                'slug' => Str::slug('Gastronomía'),
                'imagen' => '/images/amazonFairTrade/Gastronomia.webp',
                'descripcion' => 'Productos orgánicos cultivados bajo sistemas agroforestales tradicionales'
            ],
            [
                'nombre' => 'Medicina Natural',
                'slug' => Str::slug('Medicina Natural'),
                'imagen' => '/images/amazonFairTrade/Medicina.webp',
                'descripcion' => 'Remedios ancestrales basados en el conocimiento etnobotánico de la Amazonía'
            ],
            [
                'nombre' => 'Cosmética',
                'slug' => Str::slug('Cosmética'),
                'imagen' => '/images/amazonFairTrade/Cosmetica.webp',
                'descripcion' => 'Productos de belleza naturales elaborados con aceites esenciales y extractos vegetales'
            ],
        ]);
    }
}
