<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Emprendimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductoController extends Controller
{
    public function create()
    {
        $emprendimientos = Emprendimiento::all();

        return Inertia::render('Producto/Create', [ // RENDERIZA LA PAGE, no el componente
            'emprendimientos' => $emprendimientos,
        ]);
    }
    public function show($slug)
    {
        // Buscar el producto usando el slug
        $producto = Producto::where('slug', $slug)->with('emprendimiento')->first();

        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado');
        }

        // Depurar los productos del emprendimiento
        dd($producto->emprendimiento->productos);  // Esto muestra los productos asociados al emprendimiento

        return Inertia::render('Producto/Show', [
            'producto' => $producto,
        ]);
    }



    public function store(Request $request)
    {
        try {
            $request->validate([
                'emprendimiento_id' => 'required|exists:emprendimientos,id',
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'imagen' => 'nullable|image|mimes:jpg,jpeg,png',
                'imagen_2' => 'nullable|image|mimes:jpg,jpeg,png',  // Nueva imagen 2
                'imagen_3' => 'nullable|image|mimes:jpg,jpeg,png',  // Nueva imagen 3
                'imagen_4' => 'nullable|image|mimes:jpg,jpeg,png',  // Nueva imagen 4
                'etiquetas_presentacion' => 'nullable|string',
                'etiquetas_calidad' => 'nullable|string',
                'beneficios' => 'nullable|string',
                'modo_uso' => 'nullable|string',
                'origen' => 'nullable|string',
            ]);

            // Generar el slug del producto basado en su nombre
            $slug = \Str::slug($request->nombre);

            // Generar nombres únicos para las imágenes
            $imagenPath = $request->file('imagen')
                ? $request->file('imagen')->storeAs('images', 'producto_' . uniqid() . '.' . $request->imagen->extension(), 'public')
                : null;

            $imagen2Path = $request->file('imagen_2')
                ? $request->file('imagen_2')->storeAs('images', 'producto_' . uniqid() . '.' . $request->imagen_2->extension(), 'public')
                : null;

            $imagen3Path = $request->file('imagen_3')
                ? $request->file('imagen_3')->storeAs('images', 'producto_' . uniqid() . '.' . $request->imagen_3->extension(), 'public')
                : null;

            $imagen4Path = $request->file('imagen_4')
                ? $request->file('imagen_4')->storeAs('images', 'producto_' . uniqid() . '.' . $request->imagen_4->extension(), 'public')
                : null;

            $etiquetas1 = $request->etiquetas_presentacion ? (is_string($request->etiquetas_presentacion) ? $request->etiquetas_presentacion : json_encode($request->etiquetas_presentacion)) : null;
            $etiquetas2 = $request->etiquetas_calidad ? (is_string($request->etiquetas_calidad) ? $request->etiquetas_calidad : json_encode($request->etiquetas_calidad)) : null;

            // Crear el producto con el slug generado
            Producto::create([
                'emprendimiento_id' => $request->emprendimiento_id,
                'nombre' => $request->nombre,
                'slug' => $slug, // Guardamos el slug generado
                'descripcion' => $request->descripcion,
                'imagen' => $imagenPath,
                'imagen_2' => $imagen2Path,  // Guardar imagen 2
                'imagen_3' => $imagen3Path,  // Guardar imagen 3
                'imagen_4' => $imagen4Path,  // Guardar imagen 4
                'etiquetas_presentacion' => $etiquetas1,
                'etiquetas_calidad' => $etiquetas2,
                'beneficios' => $request->beneficios,
                'modo_uso' => $request->modo_uso,
                'origen' => $request->origen,
            ]);

            return redirect()->back()->with('message', 'Producto creado exitosamente.');

        } catch (\Throwable $e) {
            \Log::error('Error al crear producto: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno al guardar el producto', 'detalle' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $producto = Producto::where('slug', $slug)->firstOrFail();

            $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'imagen' => 'nullable|image|mimes:jpg,jpeg,png',
                'imagen_2' => 'nullable|image|mimes:jpg,jpeg,png',
                'imagen_3' => 'nullable|image|mimes:jpg,jpeg,png',
                'imagen_4' => 'nullable|image|mimes:jpg,jpeg,png',
                'etiquetas_presentacion' => 'nullable|string',
                'etiquetas_calidad' => 'nullable|string',
                'beneficios' => 'nullable|string',
                'modo_uso' => 'nullable|string',
                'origen' => 'nullable|string',
                'remove_imagen' => 'boolean',
                'remove_imagen_2' => 'boolean',
                'remove_imagen_3' => 'boolean',
                'remove_imagen_4' => 'boolean',
            ]);

            // Guardar el nombre original para comparar después
            $nombreOriginal = $producto->nombre;

            // Actualizar campos normales primero
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->beneficios = $request->beneficios;
            $producto->modo_uso = $request->modo_uso;
            $producto->origen = $request->origen;

            // Actualizar slug si cambia el nombre
            if ($nombreOriginal !== $request->nombre) {
                $baseSlug = \Str::slug($request->nombre);

                // Verificar si el slug ya existe
                $slugExiste = Producto::where('slug', $baseSlug)
                    ->where('id', '!=', $producto->id)
                    ->exists();

                if ($slugExiste) {
                    // Si existe, agregar un número secuencial
                    $contador = 1;
                    $nuevoSlug = $baseSlug;

                    while (
                        Producto::where('slug', $nuevoSlug)
                            ->where('id', '!=', $producto->id)
                            ->exists()
                    ) {
                        $nuevoSlug = $baseSlug . '-' . $contador;
                        $contador++;
                    }

                    $producto->slug = $nuevoSlug;
                } else {
                    // Si no existe, usar el slug base sin sufijos
                    $producto->slug = $baseSlug;
                }
            }

            // Procesar etiquetas
            $producto->etiquetas_presentacion = $request->etiquetas_presentacion ?? null;
            $producto->etiquetas_calidad = $request->etiquetas_calidad ?? null;

            // Eliminar imágenes si se solicita
            if ($request->boolean('remove_imagen') && $producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
                $producto->imagen = null;
            }

            if ($request->boolean('remove_imagen_2') && $producto->imagen_2) {
                Storage::disk('public')->delete($producto->imagen_2);
                $producto->imagen_2 = null;
            }

            if ($request->boolean('remove_imagen_3') && $producto->imagen_3) {
                Storage::disk('public')->delete($producto->imagen_3);
                $producto->imagen_3 = null;
            }

            if ($request->boolean('remove_imagen_4') && $producto->imagen_4) {
                Storage::disk('public')->delete($producto->imagen_4);
                $producto->imagen_4 = null;
            }

            // Subida de imágenes
            foreach (['imagen', 'imagen_2', 'imagen_3', 'imagen_4'] as $campo) {
                if ($request->hasFile($campo)) {
                    // Si existe una imagen anterior, eliminarla
                    if ($producto->$campo) {
                        Storage::disk('public')->delete($producto->$campo);
                    }

                    $path = $request->file($campo)->store('images/productos', 'public');
                    $producto->$campo = $path;
                }
            }

            $producto->save();

            // Redirigir a la ruta correcta usando el nuevo slug
            return redirect()->route('mis-productos')->with('message', 'Producto actualizado con éxito.');

        } catch (\Throwable $e) {
            \Log::error('Error al actualizar producto: ' . $e->getMessage());
            return response()->json([
                'error' => 'Error interno al actualizar',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }





    public function destroy($slug)
    {
        try {
            $producto = Producto::where('slug', $slug)->firstOrFail();

            // Eliminar imagen si existe
            if ($producto->imagen && \Storage::disk('public')->exists($producto->imagen)) {
                \Storage::disk('public')->delete($producto->imagen);
            }

            $producto->delete();

            return redirect()->back()->with('message', 'Producto eliminado correctamente.');
        } catch (\Throwable $e) {
            \Log::error('Error al eliminar producto: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'No se pudo eliminar el producto']);
        }
    }

}
