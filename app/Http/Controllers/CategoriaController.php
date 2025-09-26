<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Emprendimiento;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Obtener todas las categorías
    public function index()
    {
        return response()->json(Categoria::all());
    }

// 🔵 Obtener emprendimientos por categoría (todos los países) con paginación
    public function apiEmprendimientosByCategoria(Request $request, $categoria)
    {
        try {
            $query = Emprendimiento::whereHas('categoria', function ($q) use ($categoria) {
                $q->where('slug', $categoria);
            })->with(['categoria', 'pais', 'provincia']);

            // 🔵 Aplicar filtros si existen
            if ($request->filled('paises')) {
                $paises = is_array($request->paises) ? $request->paises : explode(',', $request->paises);
                $query->whereHas('pais', function ($q) use ($paises) {
                    $q->whereIn('nombre', $paises);
                });
            }

            if ($request->filled('provincias')) {
                $provincias = is_array($request->provincias) ? $request->provincias : explode(',', $request->provincias);
                $query->whereHas('provincia', function ($q) use ($provincias) {
                    $q->whereIn('nombre', $provincias);
                });
            }

            if ($request->filled('etiquetas')) {
                $etiquetas = is_array($request->etiquetas) ? $request->etiquetas : explode(',', $request->etiquetas);
                $query->where(function ($q) use ($etiquetas) {
                    foreach ($etiquetas as $etiqueta) {
                        $q->orWhere('etiquetas_1', 'LIKE', "%$etiqueta%");
                    }
                });
            }

            if ($request->filled('certificaciones')) {
                $certificaciones = is_array($request->certificaciones) ? $request->certificaciones : explode(',', $request->certificaciones);
                $query->where(function ($q) use ($certificaciones) {
                    foreach ($certificaciones as $cert) {
                        $q->orWhere('etiquetas_2', 'LIKE', "%$cert%");
                    }
                });
            }

            if ($request->filled('busqueda')) {
                $busqueda = $request->busqueda;
                $query->where(function ($q) use ($busqueda) {
                    $q->where('titulo', 'LIKE', "%$busqueda%")
                        ->orWhere('descripcion', 'LIKE', "%$busqueda%");
                });
            }

            // 🔥 Paginación de 10 por página
            $query->orderByDesc('visitas'); // Ordenar por más visitados

            $emprendimientos = $query->paginate(10);

            return response()->json($emprendimientos);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error interno al obtener emprendimientos por categoría',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function apiFiltrosByCategoria($categoria)
    {
        try {
            $emprendimientos = Emprendimiento::whereHas('categoria', function ($q) use ($categoria) {
                $q->where('slug', $categoria);
            })->with(['pais', 'provincia'])->get(); // 👈 Sin paginar

            $paises = [];
            $provincias = [];
            $etiquetas = [];
            $certificaciones = [];

            foreach ($emprendimientos as $e) {
                if ($e->pais && $e->pais->nombre) {
                    $paises[] = $e->pais->nombre;
                }
                if ($e->provincia && $e->provincia->nombre) {
                    $provincias[] = $e->provincia->nombre;
                }
                if ($e->etiquetas_1) {
                    $tags = json_decode($e->etiquetas_1, true);
                    if (is_array($tags)) {
                        $etiquetas = array_merge($etiquetas, $tags);
                    }
                }
                if ($e->etiquetas_2) {
                    $certs = json_decode($e->etiquetas_2, true);
                    if (is_array($certs)) {
                        $certificaciones = array_merge($certificaciones, $certs);
                    }
                }
            }

            return response()->json([
                'paises' => collect($paises)->unique()->values()->all(),
                'provincias' => array_values(array_unique($provincias)),
                'etiquetas' => array_values(array_unique($etiquetas)),
                'certificaciones' => array_values(array_unique($certificaciones)),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error interno al obtener filtros por categoría',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function apiFiltrosByCategoriaEcuador($categoria)
    {
        try {
            $emprendimientos = Emprendimiento::whereHas('categoria', function ($q) use ($categoria) {
                $q->where('slug', $categoria);
            })
                ->whereHas('pais', function ($q) {
                    $q->where('nombre', 'Ecuador');
                })
                ->with(['pais', 'provincia'])
                ->get(); // 👈 Sin paginar, porque queremos TODOS para los filtros

            $paises = [];
            $provincias = [];
            $etiquetas = [];
            $certificaciones = [];

            foreach ($emprendimientos as $e) {
                if ($e->pais && $e->pais->nombre) {
                    $paises[] = $e->pais->nombre;
                }
                if ($e->provincia && $e->provincia->nombre) {
                    $provincias[] = $e->provincia->nombre;
                }
                if ($e->etiquetas_1) {
                    $tags = json_decode($e->etiquetas_1, true);
                    if (is_array($tags)) {
                        $etiquetas = array_merge($etiquetas, $tags);
                    }
                }
                if ($e->etiquetas_2) {
                    $certs = json_decode($e->etiquetas_2, true);
                    if (is_array($certs)) {
                        $certificaciones = array_merge($certificaciones, $certs);
                    }
                }
            }

            return response()->json([
                'paises' => collect($paises)->unique()->values()->all(),
                'provincias' => array_values(array_unique($provincias)),
                'etiquetas' => array_values(array_unique($etiquetas)),
                'certificaciones' => array_values(array_unique($certificaciones)),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error interno al obtener filtros por categoría en Ecuador',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function apiFiltrosByCategoriaBolivia($categoria)
    {
        try {
            $emprendimientos = Emprendimiento::whereHas('categoria', function ($q) use ($categoria) {
                $q->where('slug', $categoria);
            })
                ->whereHas('pais', function ($q) {
                    $q->where('nombre', 'Bolivia');
                })
                ->with(['pais', 'provincia'])
                ->get(); // 👈 Sin paginar, porque queremos TODOS para los filtros

            $paises = [];
            $provincias = [];
            $etiquetas = [];
            $certificaciones = [];

            foreach ($emprendimientos as $e) {
                if ($e->pais && $e->pais->nombre) {
                    $paises[] = $e->pais->nombre;
                }
                if ($e->provincia && $e->provincia->nombre) {
                    $provincias[] = $e->provincia->nombre;
                }
                if ($e->etiquetas_1) {
                    $tags = json_decode($e->etiquetas_1, true);
                    if (is_array($tags)) {
                        $etiquetas = array_merge($etiquetas, $tags);
                    }
                }
                if ($e->etiquetas_2) {
                    $certs = json_decode($e->etiquetas_2, true);
                    if (is_array($certs)) {
                        $certificaciones = array_merge($certificaciones, $certs);
                    }
                }
            }

            return response()->json([
                'paises' => collect($paises)->unique()->values()->all(),
                'provincias' => array_values(array_unique($provincias)),
                'etiquetas' => array_values(array_unique($etiquetas)),
                'certificaciones' => array_values(array_unique($certificaciones)),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error interno al obtener filtros por categoría en Bolivia',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }



    // 🟢 Obtener emprendimientos por categoría SOLO de Ecuador con paginación
    // 🟢 Obtener emprendimientos por categoría SOLO de Ecuador con paginación real
    public function apiEmprendimientosByCategoriaEcuador(Request $request, $categoria)
    {
        try {
            $query = Emprendimiento::whereHas('categoria', function ($q) use ($categoria) {
                $q->where('slug', $categoria);
            })
                ->whereHas('pais', function ($q) {
                    $q->where('nombre', 'Ecuador');
                })
                ->with(['categoria', 'pais', 'provincia']);

            // 🔵 Aplicar filtros si existen
            if ($request->filled('paises')) {
                $paises = is_array($request->paises) ? $request->paises : explode(',', $request->paises);
                $query->whereHas('pais', function ($q) use ($paises) {
                    $q->whereIn('nombre', $paises);
                });
            }

            if ($request->filled('provincias')) {
                $provincias = is_array($request->provincias) ? $request->provincias : explode(',', $request->provincias);
                $query->whereHas('provincia', function ($q) use ($provincias) {
                    $q->whereIn('nombre', $provincias);
                });
            }

            if ($request->filled('etiquetas')) {
                $etiquetas = is_array($request->etiquetas) ? $request->etiquetas : explode(',', $request->etiquetas);
                $query->where(function ($q) use ($etiquetas) {
                    foreach ($etiquetas as $etiqueta) {
                        $q->orWhere('etiquetas_1', 'LIKE', "%$etiqueta%");
                    }
                });
            }

            if ($request->filled('certificaciones')) {
                $certificaciones = is_array($request->certificaciones) ? $request->certificaciones : explode(',', $request->certificaciones);
                $query->where(function ($q) use ($certificaciones) {
                    foreach ($certificaciones as $cert) {
                        $q->orWhere('etiquetas_2', 'LIKE', "%$cert%");
                    }
                });
            }

            if ($request->filled('busqueda')) {
                $busqueda = $request->busqueda;
                $query->where(function ($q) use ($busqueda) {
                    $q->where('titulo', 'LIKE', "%$busqueda%")
                        ->orWhere('descripcion', 'LIKE', "%$busqueda%");
                });
            }

            // 🔥 Paginación de 10 por página
            $query->orderByDesc('visitas'); // Ordenar por más visitados

            $emprendimientos = $query->paginate(9);

            return response()->json($emprendimientos);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error interno al obtener emprendimientos de Ecuador',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function apiEmprendimientosByCategoriaBolivia(Request $request, $categoria)
    {
        try {
            $query = Emprendimiento::whereHas('categoria', function ($q) use ($categoria) {
                $q->where('slug', $categoria);
            })
                ->whereHas('pais', function ($q) {
                    $q->where('nombre', 'Bolivia');
                })
                ->with(['categoria', 'pais', 'provincia']);

            // 🔵 Aplicar filtros si existen
            if ($request->filled('paises')) {
                $paises = is_array($request->paises) ? $request->paises : explode(',', $request->paises);
                $query->whereHas('pais', function ($q) use ($paises) {
                    $q->whereIn('nombre', $paises);
                });
            }

            if ($request->filled('provincias')) {
                $provincias = is_array($request->provincias) ? $request->provincias : explode(',', $request->provincias);
                $query->whereHas('provincia', function ($q) use ($provincias) {
                    $q->whereIn('nombre', $provincias);
                });
            }

            if ($request->filled('etiquetas')) {
                $etiquetas = is_array($request->etiquetas) ? $request->etiquetas : explode(',', $request->etiquetas);
                $query->where(function ($q) use ($etiquetas) {
                    foreach ($etiquetas as $etiqueta) {
                        $q->orWhere('etiquetas_1', 'LIKE', "%$etiqueta%");
                    }
                });
            }

            if ($request->filled('certificaciones')) {
                $certificaciones = is_array($request->certificaciones) ? $request->certificaciones : explode(',', $request->certificaciones);
                $query->where(function ($q) use ($certificaciones) {
                    foreach ($certificaciones as $cert) {
                        $q->orWhere('etiquetas_2', 'LIKE', "%$cert%");
                    }
                });
            }

            if ($request->filled('busqueda')) {
                $busqueda = $request->busqueda;
                $query->where(function ($q) use ($busqueda) {
                    $q->where('titulo', 'LIKE', "%$busqueda%")
                        ->orWhere('descripcion', 'LIKE', "%$busqueda%");
                });
            }

            // 🔥 Paginación de 10 por página
            $query->orderByDesc('visitas'); // Ordenar por más visitados

            $emprendimientos = $query->paginate(9);

            return response()->json($emprendimientos);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error interno al obtener emprendimientos de Bolivia',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }



}
