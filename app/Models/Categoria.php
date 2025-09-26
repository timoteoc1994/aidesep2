<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug', 'imagen', 'descripcion'];

    public function emprendimientos()
    {
        return $this->hasMany(Emprendimiento::class);
    }
}
