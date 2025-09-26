<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Pais;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::latest()->with('pais')->get();

        return Inertia::render('CreateNoticia', [
            'noticias' => $noticias,
            'paises' => Pais::all(),
        ]);
    }

    public function create()
    {
        return Inertia::render('CreateNoticia', [
            'paises' => Pais::all(),
        ]);
    }

    public function noticiasGlobales()
    {
        $noticias = Noticia::where('es_global', true)
            ->orderBy('fecha', 'desc')
            ->get();

        return Inertia::render('Noticias', [
            'noticias' => $noticias
        ]);
    }


    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'fecha' => 'nullable|date',
                'autor' => 'nullable|string|max:255',
                'ubicacion' => 'nullable|string|max:255',
                'es_global' => 'required|boolean',
                'pais_id' => 'nullable|exists:paises,id',
                'imagen' => 'nullable|image|max:5120',
            ]);

            // Validación condicional: si no es global, debe tener país
            if (!$data['es_global'] && !$request->filled('pais_id')) {
                return back()->withErrors([
                    'pais_id' => 'El campo país es obligatorio si la noticia no es global.'
                ])->withInput();
            }

            // Generar slug único basado en el título
            $slug = Str::slug($data['titulo']);
            $originalSlug = $slug;
            $counter = 1;

            while (Noticia::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $data['slug'] = $slug;

            // Guardar imagen si existe
            if ($request->hasFile('imagen')) {
                $data['imagen'] = $request->file('imagen')->store('noticias', 'public');
            }

            // Crear la noticia
            Noticia::create($data);

            return redirect()->route('noticias.index')->with('message', 'Noticia creada correctamente.');

        } catch (\Throwable $e) {
            Log::error('Error al crear noticia: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error interno al crear la noticia.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($slug)
    {
        $noticia = Noticia::where('slug', $slug)->with('pais')->firstOrFail();
        $paises = Pais::all();

        return Inertia::render('EditarNoticia', [
            'noticia' => $noticia,
            'paises' => $paises,
        ]);
    }

    public function update(Request $request, $slug)
    {
        try {
            $noticia = Noticia::where('slug', $slug)->firstOrFail();

            // 🔍 Convertir manualmente los valores que puedan venir mal del FormData
            $esGlobal = filter_var($request->input('es_global'), FILTER_VALIDATE_BOOLEAN);
            $paisId = $request->input('pais_id') !== '' ? $request->input('pais_id') : null;

            // 🧪 Validación sin incluir boolean directamente
            $data = $request->validate([
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'fecha' => 'nullable|date',
                'autor' => 'nullable|string|max:255',
                'ubicacion' => 'nullable|string|max:255',
                'imagen' => 'nullable|image|max:5120',
            ]);

            // ✅ Añadir campos manuales
            $data['es_global'] = $esGlobal;
            $data['pais_id'] = $paisId;

            // ⛔ Validación condicional extra
            if (!$esGlobal && !$paisId) {
                return back()->withErrors([
                    'pais_id' => 'El campo país es obligatorio si la noticia no es global.'
                ])->withInput();
            }

            // 🔁 Actualizar slug si el título cambió
            if ($data['titulo'] !== $noticia->titulo) {
                $newSlug = Str::slug($data['titulo']);
                $originalSlug = $newSlug;
                $counter = 1;

                while (Noticia::where('slug', $newSlug)->where('id', '!=', $noticia->id)->exists()) {
                    $newSlug = $originalSlug . '-' . $counter++;
                }

                $data['slug'] = $newSlug;
            }

            // 🖼 Reemplazar imagen si viene una nueva
            if ($request->hasFile('imagen')) {
                $data['imagen'] = $request->file('imagen')->store('noticias', 'public');
            }

            // 💾 Actualizar la noticia
            $noticia->update($data);

            return redirect()->route('noticias.listado')->with('message', 'Noticia actualizada correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error al actualizar noticia: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error interno al actualizar la noticia.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function listado()
    {
        $noticias = Noticia::with('pais')
            ->orderBy('fecha', 'desc')
            ->paginate(10); // Paginación real

        return Inertia::render('ListarNoticias', [
            'noticias' => $noticias,
        ]);
    }

    public function destroy($slug)
    {
        try {
            $noticia = Noticia::where('slug', $slug)->firstOrFail();
            $noticia->delete();

            return redirect()->back()->with('message', 'Noticia eliminada correctamente.');
        } catch (\Throwable $e) {
            Log::error('Error al eliminar noticia: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error al eliminar la noticia.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
