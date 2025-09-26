<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use App\Models\Emprendimiento;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    public function index($pais)
    {
        return response()->json(Provincia::where('pais_id', $pais)->get());
    }

    private function getMapaCodigoProvincia()
    {
        return [
            'ECU' => 'sucumbios',
            'ECS' => 'morona-santiago',
            'ECN' => 'napo',
            'ECD' => 'orellana',
            'ECY' => 'pastaza',
            'ECZ' => 'zamora-chinchipe',
            'ECW' => 'francisco-de-orellana',
            // Bolivia - Provincias y Departamentos amazónicos
            'PAN' => 'abuna',
            'ELB' => 'el-beni',
            'LAP' => 'la-paz',
            'SAN' => 'santa-cruz',
            'COC' => 'cochabamba',
            'CHU' => 'chuquisaca',
            'POT' => 'potosi',
            'ORU' => 'oruro',
            'TAR' => 'tarija',

            // Subprovincias o regiones adicionales del área amazónica (pando, beni, etc.)
            'PAN1' => 'manuripi',
            'PAN2' => 'madre-de-dios',
            'PAN3' => 'federico-roman',
            'ELB1' => 'ballivian',
            'ELB2' => 'yacuma',
            'ELB3' => 'vaca-diez',
            'LAP1' => 'iturralde',
            'ELB4' => 'cercado',
            'SAN1' => 'andres-ibanez',
            'SAN2' => 'velasco',

        ];
    }

    // 🔵 Filtros disponibles por provincia (solo Ecuador)
    public function apiFiltrosByProvincia($codigo)
    {
        try {
            $mapaCodigoProvincia = $this->getMapaCodigoProvincia();

            if (!isset($mapaCodigoProvincia[$codigo])) {
                return response()->json([
                    'message' => 'Código de provincia inválido',
                ], 404);
            }

            $slugProvincia = $mapaCodigoProvincia[$codigo];

            $emprendimientos = Emprendimiento::whereHas('provincia', function ($q) use ($slugProvincia) {
                $q->where('slug', $slugProvincia);
            })
            ->whereHas('pais', function ($q) {
                $q->where('nombre', 'Ecuador');
            })
            ->with(['pais', 'provincia'])
            ->get(); // Sin paginar para filtros

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
                'provincias' => collect($provincias)->unique()->values()->all(),
                'etiquetas' => collect($etiquetas)->unique()->values()->all(),
                'certificaciones' => collect($certificaciones)->unique()->values()->all(),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error interno al obtener filtros por provincia',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }


    public function apiFiltrosByProvinciaBolivia($codigo)
    {
        try {
            $mapaCodigoProvincia = $this->getMapaCodigoProvincia();

            if (!isset($mapaCodigoProvincia[$codigo])) {
                return response()->json([
                    'message' => 'Código de provincia inválido',
                ], 404);
            }

            $slugProvincia = $mapaCodigoProvincia[$codigo];

            $emprendimientos = Emprendimiento::whereHas('provincia', function ($q) use ($slugProvincia) {
                $q->where('slug', $slugProvincia);
            })
                ->whereHas('pais', function ($q) {
                    $q->where('nombre', 'Bolivia');
                })
                ->with(['pais', 'provincia'])
                ->get(); // Sin paginar para filtros

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
                'provincias' => collect($provincias)->unique()->values()->all(),
                'etiquetas' => collect($etiquetas)->unique()->values()->all(),
                'certificaciones' => collect($certificaciones)->unique()->values()->all(),
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error interno al obtener filtros por provincia',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    // 🔵 Obtener emprendimientos por provincia (solo Ecuador) con filtros + paginación
    public function apiEmprendimientosByProvincia(Request $request, $codigo)
    {
        try {
            $mapaCodigoProvincia = $this->getMapaCodigoProvincia();

            if (!isset($mapaCodigoProvincia[$codigo])) {
                return response()->json([
                    'message' => 'Código de provincia inválido',
                ], 404);
            }

            $slugProvincia = $mapaCodigoProvincia[$codigo];

            $query = Emprendimiento::whereHas('provincia', function ($q) use ($slugProvincia) {
                $q->where('slug', $slugProvincia);
            })
            ->whereHas('pais', function ($q) {
                $q->where('nombre', 'Ecuador');
            })
            ->with(['categoria', 'pais', 'provincia']);

            // 🔵 Aplicar todos los filtros si existen
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
                    foreach ($etiquetas as $tag) {
                        $q->orWhere('etiquetas_1', 'LIKE', "%$tag%");
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
            $emprendimientos = $query->paginate(10);

            return response()->json($emprendimientos);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error interno al obtener emprendimientos por provincia',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }


    public function apiEmprendimientosByProvinciaBolivia(Request $request, $codigo)
    {
        try {
            $mapaCodigoProvincia = $this->getMapaCodigoProvincia();

            if (!isset($mapaCodigoProvincia[$codigo])) {
                return response()->json([
                    'message' => 'Código de provincia inválido',
                ], 404);
            }

            $slugProvincia = $mapaCodigoProvincia[$codigo];

            $query = Emprendimiento::whereHas('provincia', function ($q) use ($slugProvincia) {
                $q->where('slug', $slugProvincia);
            })
                ->whereHas('pais', function ($q) {
                    $q->where('nombre', 'Bolivia');
                })
                ->with(['categoria', 'pais', 'provincia']);

            // 🔵 Aplicar todos los filtros si existen
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
                    foreach ($etiquetas as $tag) {
                        $q->orWhere('etiquetas_1', 'LIKE', "%$tag%");
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
            $emprendimientos = $query->paginate(10);

            return response()->json($emprendimientos);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error interno al obtener emprendimientos por provincia',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }
}
