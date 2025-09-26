<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pais extends Model
{
    use HasFactory;

    // Especificar que la tabla es 'paises'
    protected $table = 'paises';  // Esto indica que el modelo utiliza la tabla 'paises'

    protected $fillable = ['nombre', 'slug'];

    // Relaciones
    public function provincias()
    {
        return $this->hasMany(Provincia::class);
    }

    public function emprendimientos()
    {
        return $this->hasMany(Emprendimiento::class);
    }
}
