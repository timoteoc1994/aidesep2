<?php

namespace App\Http\Controllers;

use App\Models\Emprendimiento;
use App\Models\Producto;
use App\Models\Noticia;
use App\Models\User;
use App\Models\Pais;
use App\Models\Categoria;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'dashboardStats' => [
                'total_emprendimientos' => Emprendimiento::count(),
                'total_productos' => Producto::count(),
                'total_noticias' => Noticia::count(),
                'total_usuarios' => User::count(),
                'total_paises' => Pais::count(),
                'total_categorias' => Categoria::count(),
            ]
        ]);
    }
}

