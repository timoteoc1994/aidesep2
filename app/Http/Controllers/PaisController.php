<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    public function index()
    {
        try {
            $paises = Pais::all(); // O la consulta que necesites
            return response()->json($paises);
        } catch (\Exception $e) {
            // Registrar el error en los logs
            \Log::error("Error al cargar países: " . $e->getMessage());
            return response()->json(['error' => 'Error al cargar países'], 500);
        }
    }
}

