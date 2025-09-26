<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmprendimientosTable extends Migration
{
    public function up(): void
    {
        Schema::create('emprendimientos', function (Blueprint $table) {
            $table->id();

            // Campos de información básica
            $table->string('titulo')->nullable();
            $table->text('descripcion')->nullable();
            $table->json('etiquetas_1')->nullable();
            $table->json('etiquetas_2')->nullable();
            $table->string('imagen_principal')->nullable();
            $table->string('imagen_logo')->nullable();
            $table->string('imagen_logo_con_nombre')->nullable();
            $table->string('imagen_secundaria')->nullable();

            // Datos de "Nosotros"
            $table->string('imagen_1_nosotros')->nullable();
            $table->string('titulo_1_nosotros')->nullable();
            $table->text('texto_1_nosotros')->nullable();
            $table->string('imagen_2_nosotros')->nullable();
            $table->string('titulo_2_nosotros')->nullable();
            $table->text('texto_2_nosotros')->nullable();

            // Misión
            $table->string('titulo_mision')->nullable();
            $table->text('texto_mision')->nullable();

            // Mapa
            $table->string('titulo_mapa')->nullable();
            $table->text('texto_mapa')->nullable();
            $table->string('ubicacion_google_maps')->nullable();

            // Contacto
            $table->string('correo_electronico')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('direccion')->nullable();

            // Colores
            $table->string('color_principal_1')->nullable();
            $table->string('color_secundario_1')->nullable();
            $table->string('color_secundario_2')->nullable();

            // Relaciones
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->foreignId('pais_id')->constrained('paises')->onDelete('cascade');
            $table->foreignId('provincia_id')->constrained('provincias')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emprendimientos');
    }
}
