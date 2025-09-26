<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'emprendimiento_id',
        'nombre',
        'slug', // Agregado el campo slug aquí
        'descripcion',
        'imagen',
        'imagen_2',         // Nueva imagen 1
        'imagen_3',         // Nueva imagen 2
        'imagen_4',         // Nueva imagen 3
        'etiquetas_presentacion', // ➡️ etiquetas para tamaño/presentaciones
        'etiquetas_calidad',       // ➡️ etiquetas de cualidades (orgánico, natural, etc)
        'beneficios',              // ➡️ texto rico
        'modo_uso',                // ➡️ texto normal
        'origen',                  // ➡️ texto normal
    ];

    public function emprendimiento()
    {
        return $this->belongsTo(Emprendimiento::class);
    }
    
}
