<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('emprendimientos', function (Blueprint $table) {
            // NO agregar slug, facebook_url, instagram_url, linkedin_url porque YA existen.

            // Agregar solo color_secundario_3
            $table->string('color_secundario_3')->nullable()->after('color_secundario_2');
        });
    }

    public function down()
    {
        Schema::table('emprendimientos', function (Blueprint $table) {
            $table->dropColumn('color_secundario_3');
        });
    }
};
