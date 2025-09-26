<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('emprendimientos', function (Blueprint $table) {
            $table->dropColumn('color_secundario_3');
        });
    }

    public function down(): void
    {
        Schema::table('emprendimientos', function (Blueprint $table) {
            $table->string('color_secundario_3')->nullable();
        });
    }

};
