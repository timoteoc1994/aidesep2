<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug', 'pais_id'];

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function emprendimientos()
    {
        return $this->hasMany(Emprendimiento::class);
    }
}
