<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $fillable = [
        'titulo',
        'slug',
        'descripcion',
        'fecha',
        'autor',
        'ubicacion',
        'pais_id',
        'es_global',
        'imagen',
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }
}
