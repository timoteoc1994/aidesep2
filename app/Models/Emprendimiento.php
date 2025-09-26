<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emprendimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'slug', 'descripcion', 'imagen_principal', 'imagen_logo', 'imagen_logo_con_nombre',
        'imagen_secundaria', 'imagen_1_nosotros', 'titulo_1_nosotros', 'texto_1_nosotros',
        'imagen_2_nosotros', 'titulo_2_nosotros', 'texto_2_nosotros', 'titulo_mision',
        'texto_mision', 'titulo_mapa', 'texto_mapa', 'ubicacion_google_maps', 'correo_electronico',
        'telefono', 'celular', 'ubicacion', 'direccion', 'color_principal_1', 'color_secundario_1',
        'color_secundario_2', 'producto_id', 'categoria_id', 'pais_id', 'provincia_id', 'etiquetas_1', 'etiquetas_2',
        'facebook_url', 'instagram_url', 'linkedin_url', 'web_url',
        'youtube_url','tiktok_url' ,'user_id',
        'visitas',

    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
