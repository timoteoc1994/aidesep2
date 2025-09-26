<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Emprendimiento;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // 👈 importante para slug
use Illuminate\Support\Facades\Auth;

class EmprendimientoController extends Controller
{
    public function create()
    {
        // Recuperar categorías, países y provincias
        $categorias = Categoria::all();
        $paises = Pais::all();

        return Inertia::render('Emprendimiento/Create', [
            'categorias' => $categorias,
            'paises' => $paises,
        ]);
    }

    public function edit()
    {
        $user = auth()->user();
        $emprendimiento = $user->emprendimiento;

        if (!$emprendimiento) {
            abort(404, 'No tienes un emprendimiento registrado.');
        }

        $categorias = Categoria::all();
        $paises = Pais::all();

        return inertia('EditarEmprendimiento', [
            'emprendimiento' => $emprendimiento,
            'categorias' => $categorias,
            'paises' => $paises,
        ]);

    }
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen_principal' => 'nullable|image|mimes:jpg,jpeg,png',
            'imagen_logo' => 'nullable|image|mimes:jpg,jpeg,png',
            'categoria_id' => 'required|exists:categorias,id',
            'pais_id' => 'required|exists:paises,id',
            'provincia_id' => 'required|exists:provincias,id',
            'etiquetas_1' => 'nullable|string',  // Validación de etiquetas_1
            'etiquetas_2' => 'nullable|string',  // Validación de etiquetas_2
            'correo_electronico' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'imagen_1_nosotros' => 'nullable|image|max:5120',
            'imagen_2_nosotros' => 'nullable|image|max:5120',

            'instagram_url' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|max:255',
            'web_url' => 'nullable|string|max:255',
            'tiktok_url' => 'nullable|string|max:255',
            'youtube_url' => 'nullable|string|max:255',
            // Nosotros
            'titulo_1_nosotros' => 'nullable|string|max:255',
            'texto_1_nosotros' => 'nullable|string',
            'titulo_2_nosotros' => 'nullable|string|max:255',
            'texto_2_nosotros' => 'nullable|string',

            // Misión
            'titulo_mision' => 'nullable|string|max:255',
            'texto_mision' => 'nullable|string',

            // Mapa
            'titulo_mapa' => 'nullable|string|max:255',
            'texto_mapa' => 'nullable|string',
            'ubicacion_google_maps' => 'nullable|string|max:255',

            // Contacto
            'telefono' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'ubicacion' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',

        ]);

        // Crear el usuario autenticable para el emprendimiento
        $user = \App\Models\User::create([
            'name' => $request->titulo,
            'email' => $request->correo_electronico,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role_id' => 2, // Rol: AdminEmprendimientos
        ]);
        // Subir las imágenes, si existen
        // Subir todas las imágenes, si existen
        $imagenPrincipalPath = $request->file('imagen_principal')
            ? $request->file('imagen_principal')->storeAs('images', 'imagen_principal_' . time() . '.' . $request->imagen_principal->extension(), 'public')
            : null;

        $imagenLogoPath = $request->file('imagen_logo')
            ? $request->file('imagen_logo')->storeAs('images', 'imagen_logo_' . time() . '.' . $request->imagen_logo->extension(), 'public')
            : null;

        $imagenLogoConNombrePath = $request->file('imagen_logo_con_nombre')
            ? $request->file('imagen_logo_con_nombre')->storeAs('images', 'imagen_logo_con_nombre_' . time() . '.' . $request->imagen_logo_con_nombre->extension(), 'public')
            : null;

        $imagenSecundariaPath = $request->file('imagen_secundaria')
            ? $request->file('imagen_secundaria')->storeAs('images', 'imagen_secundaria_' . time() . '.' . $request->imagen_secundaria->extension(), 'public')
            : null;

        $imagen1NosotrosPath = $request->file('imagen_1_nosotros')
            ? $request->file('imagen_1_nosotros')->storeAs('images', 'imagen_1_nosotros_' . time() . '.' . $request->imagen_1_nosotros->extension(), 'public')
            : null;

        $imagen2NosotrosPath = $request->file('imagen_2_nosotros')
            ? $request->file('imagen_2_nosotros')->storeAs('images', 'imagen_2_nosotros_' . time() . '.' . $request->imagen_2_nosotros->extension(), 'public')
            : null;

        // Convertir las etiquetas de texto a JSON (si existen)
        $etiquetas1 = $request->etiquetas_1 ? (is_string($request->etiquetas_1) ? $request->etiquetas_1 : json_encode($request->etiquetas_1)) : null;
        $etiquetas2 = $request->etiquetas_2 ? (is_string($request->etiquetas_2) ? $request->etiquetas_2 : json_encode($request->etiquetas_2)) : null;
        // Crear el emprendimiento
        $emprendimiento = Emprendimiento::create([
            'titulo' => $request->titulo,
            'slug' => Str::slug($request->titulo),
            'descripcion' => $request->descripcion,
            'imagen_principal' => $imagenPrincipalPath,
            'imagen_logo' => $imagenLogoPath,
            'imagen_logo_con_nombre' => $imagenLogoConNombrePath,
            'imagen_secundaria' => $imagenSecundariaPath,
            'imagen_1_nosotros' => $imagen1NosotrosPath,
            'titulo_1_nosotros' => $request->titulo_1_nosotros,
            'texto_1_nosotros' => $request->texto_1_nosotros,
            'imagen_2_nosotros' => $imagen2NosotrosPath,
            'titulo_2_nosotros' => $request->titulo_2_nosotros,
            'texto_2_nosotros' => $request->texto_2_nosotros,
            'titulo_mision' => $request->titulo_mision,
            'texto_mision' => $request->texto_mision,
            'titulo_mapa' => $request->titulo_mapa,
            'texto_mapa' => $request->texto_mapa,
            'ubicacion_google_maps' => $request->ubicacion_google_maps,
            'correo_electronico' => $request->correo_electronico,
            'telefono' => $request->telefono,
            'celular' => $request->celular,
            'ubicacion' => $request->ubicacion,
            'direccion' => $request->direccion,
            'color_principal_1' => $request->color_principal_1,
            'color_secundario_1' => $request->color_secundario_1,
            'color_secundario_2' => $request->color_secundario_2,
            'categoria_id' => $request->categoria_id,
            'pais_id' => $request->pais_id,
            'provincia_id' => $request->provincia_id,
            'etiquetas_1' => $etiquetas1,
            'etiquetas_2' => $etiquetas2,
            'facebook_url' => $request->facebook_url ?: null,
            'instagram_url' => $request->instagram_url ?: null,
            'linkedin_url' => $request->linkedin_url ?: null,
            'tiktok_url' => $request->tiktok_url ?: null,
            'youtube_url' => $request->youtube_url ?: null,
            'web_url' => $request->web_url ?: null,
            'user_id' => $user->id,
        ]);

    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $emprendimiento = $user->emprendimiento;

        if (!$emprendimiento) {
            abort(404, 'No tienes un emprendimiento registrado.');
        }

        $data = $request->validate([
            // Datos básicos
            'titulo' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'descripcion' => 'required|string',

            // Imágenes
            'imagen_principal' => 'nullable|image|max:5120',
            'imagen_logo' => 'nullable|image|max:5120',
            'imagen_logo_con_nombre' => 'nullable|image|max:5120',
            'imagen_secundaria' => 'nullable|image|max:5120',
            'imagen_1_nosotros' => 'nullable|image|max:5120',
            'imagen_2_nosotros' => 'nullable|image|max:5120',

            // Nosotros
            'titulo_1_nosotros' => 'nullable|string|max:255',
            'texto_1_nosotros' => 'nullable|string',
            'titulo_2_nosotros' => 'nullable|string|max:255',
            'texto_2_nosotros' => 'nullable|string',

            // Misión
            'titulo_mision' => 'nullable|string|max:255',
            'texto_mision' => 'nullable|string',

            // Mapa
            'titulo_mapa' => 'nullable|string|max:255',
            'texto_mapa' => 'nullable|string',
            'ubicacion_google_maps' => 'nullable|string|max:255',

            // Contacto
            'correo_electronico' => 'nullable|email',
            'telefono' => 'nullable|string|max:20',
            'celular' => 'nullable|string|max:20',
            'ubicacion' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',

            // Redes sociales
            'facebook_url' => 'nullable|string|max:255',
            'instagram_url' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|max:255',
            'web_url' => 'nullable|string|max:255',
            'tiktok_url' => 'nullable|string|max:255',
            'youtube_url' => 'nullable|string|max:255',

            // Colores
            'color_principal_1' => 'nullable|string|max:7',
            'color_secundario_1' => 'nullable|string|max:7',
            'color_secundario_2' => 'nullable|string|max:7',

            // Etiquetas
            'etiquetas_1' => 'nullable|json',
            'etiquetas_2' => 'nullable|json',

            // Relaciones
            'categoria_id' => 'required|exists:categorias,id',
            'pais_id' => 'required|exists:paises,id',
            'provincia_id' => 'required|exists:provincias,id',

        ]);
        $data['slug'] = Str::slug($data['titulo']); // 👈 ACTUALIZA SLUG

        // Manejo de imágenes nuevas (reemplaza las antiguas si vienen nuevas)
        // Manejo de imágenes: conservar anteriores si no se actualizan
        foreach (['imagen_principal', 'imagen_logo', 'imagen_logo_con_nombre', 'imagen_secundaria', 'imagen_1_nosotros', 'imagen_2_nosotros'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('images', 'public');
            } elseif ($request->has($field . '_actual')) {
                $data[$field] = $request->input($field . '_actual'); // conservar imagen existente
            } else {
                unset($data[$field]); // no tocar si no hay dato
            }
        }


        // Solo actualiza la contraseña si se proporciona una nueva
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
            $user->save();
        } else {
            unset($data['password']);
        }

        $emprendimiento->update($data);

        return redirect()->back()->with('message', 'Emprendimiento actualizado con éxito.');
    }

    public function listado()
    {
        $emprendimientos = Emprendimiento::with(['categoria', 'pais', 'provincia'])
            ->latest()
            ->paginate(9); // puedes ajustar la paginación

        return Inertia::render('Listado', [
            'emprendimientos' => $emprendimientos
        ]);
    }


}
