<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToProductosTable extends Migration
{
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->json('etiquetas_presentacion')->nullable()->after('imagen');  // Etiquetas de tamaños (200g, 400g)
            $table->json('etiquetas_calidad')->nullable()->after('etiquetas_presentacion'); // Etiquetas de calidad (orgánico, natural)
            $table->text('beneficios')->nullable()->after('etiquetas_calidad');    // Beneficios
            $table->text('modo_uso')->nullable()->after('beneficios');              // Modo de uso
            $table->text('origen')->nullable()->after('modo_uso');                  // Origen
        });
    }

    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn([
                'etiquetas_presentacion',
                'etiquetas_calidad',
                'beneficios',
                'modo_uso',
                'origen',
            ]);
        });
    }
}
