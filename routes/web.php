<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmprendimientoController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ProductoController;
use App\Models\Emprendimiento;
use App\Models\Producto;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ProvinciaController;

/**
 * 🌐 RUTAS PÚBLICAS
 */
Route::get('/', fn() => Inertia::render('ConAmazonia'));
Route::get('/login', fn() => Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
]));
Route::get('/conAmazonia', fn() => Inertia::render('ConAmazonia'));
Route::get('/conBolivia', fn() => Inertia::render('ConBolivia'));
Route::get('/pais/{codigo}', fn($codigo) => Inertia::render('PaisView', ['codigo' => $codigo]));
Route::get('/emprendimientos/{categoria}', fn($categoria) => Inertia::render('Emprendimientos', ['categoria' => $categoria]))->name('emprendimientos.show');
Route::get('/emprendimientosPaises/{categoria}', fn($categoria) => Inertia::render('EmprendimientosPaises', ['categoria' => $categoria]))->name('emprendimientosPaises.show');
Route::get('/emprendimientosBolivia/{categoria}', fn($categoria) => Inertia::render('EmprendimientosBolivia', ['categoria' => $categoria]))->name('EmprendimientosBolivia.show');

Route::get('/emprendimiento/{slug}', function ($slug) {
    $emprendimiento = Emprendimiento::where('slug', $slug)
        ->with(['categoria', 'pais', 'provincia', 'productos'])
        ->firstOrFail();

    // Incrementa visitas sin actualizar timestamps
    DB::table('emprendimientos')->where('id', $emprendimiento->id)->increment('visitas');

    return Inertia::render('EmprendimientoProfile', [
        'emprendimiento' => $emprendimiento
    ]);
});
Route::get('/mis-productos', function () {
    $user = Auth::user();

    // Obtener el único emprendimiento del usuario, con sus productos
    $emprendimiento = $user->emprendimientos()->with('productos')->first();

    return Inertia::render('MisProductos', [
        'productos' => $emprendimiento?->productos ?? [],
        'emprendimiento' => $emprendimiento,
    ]);
})->middleware(['auth'])->name('mis-productos');

Route::get('/editar-producto/{slug}', function ($slug) {
    $producto = Producto::where('slug', $slug)->with('emprendimiento')->firstOrFail();

    return Inertia::render('EditarProducto', [
        'producto' => $producto,
        'emprendimiento' => $producto->emprendimiento,
    ]);
})->middleware(['auth'])->name('producto.edit');

Route::put('/editar-producto/{slug}', [ProductoController::class, 'update'])->middleware(['auth'])->name('producto.update');
Route::delete('/eliminar-producto/{slug}', [ProductoController::class, 'destroy'])->middleware('auth')->name('producto.destroy');


Route::get('/producto/{slug}', function ($slug) {
    $producto = Producto::where('slug', $slug)
        ->with([
            'emprendimiento' => function ($query) {
                $query->with('productos');  // Cargar productos relacionados con el emprendimiento
            }
        ])
        ->firstOrFail(); // Obtiene el producto con su emprendimiento y sus productos


    return Inertia::render('ProductoDetalle', [
        'producto' => $producto, // Pasa el producto actual al componente
        'productosRestantes' => $producto->emprendimiento->productos->where('id', '!=', $producto->id), // Excluir el producto actual de la lista de productos restantes
    ]);
});



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');Route::get('/emprendimientosProvincia/{codigo}', fn($codigo) => Inertia::render('EmprendimientosProvincia', ['codigo' => $codigo]))->name('EmprendimientosProvincia.show');

// Ruta para mostrar emprendimientos por provincia (Bolivia)
Route::get('/emprendimientosProvinciaBolivia/{codigo}', function ($codigo) {
    return Inertia::render('EmprendimientosProvinciaBolivia', ['codigo' => $codigo]);
})->name('EmprendimientosProvinciaBolivia.show');

Route::get('/create', fn() => Inertia::render('CrearEmprendimiento'))->middleware(['verified'])->name('create');
Route::get('/create-product', function () {
    $emprendimientos = Emprendimiento::all();  // Obtener todos los emprendimientos
    return Inertia::render('CrearProducto', [
        'emprendimientos' => $emprendimientos,
    ]);
})->middleware(['verified'])->name('create-product');

Route::middleware('auth')->group(function () {
    Route::get('/about', fn () => Inertia::render('About'))->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/crear-emprendimiento', [EmprendimientoController::class, 'create'])->name('emprendimiento.create.superadmin');
    Route::post('/crear-emprendimiento', [EmprendimientoController::class, 'store'])->name('emprendimiento.store');

    // ✨ Agregado para productos
    Route::get('/crear-producto', [ProductoController::class, 'create'])->name('producto.create');
    Route::post('/crear-producto', [ProductoController::class, 'store'])->name('producto.store');

    Route::get('/crear-admin', [UserManagementController::class, 'create'])->name('admin.create');
    Route::post('/crear-admin', [UserManagementController::class, 'store']);

});

Route::middleware(['auth', 'role:AdminEmprendimientos'])->group(function () {
    Route::get('/emprendedor/crear-emprendimiento', [UserManagementController::class, 'create'])->name('emprendimiento.create.admin');
    Route::post('/emprendedor/crear-emprendimiento', [UserManagementController::class, 'store']);
});

/**
 * 📦 API (Web agrupadas con prefix)
 */

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/editar-emprendimiento', [EmprendimientoController::class, 'edit'])
        ->name('emprendimiento.edit');
    Route::put('/editar-emprendimiento', [EmprendimientoController::class, 'update'])
        ->name('emprendimiento.update');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/crear-noticia', [NoticiaController::class, 'create'])->name('noticias.create');
    Route::post('/crear-noticia', [NoticiaController::class, 'store'])->name('noticias.store');
    Route::get('/noticias', [NoticiaController::class, 'index'])->name('noticias.index');

});
Route::get('/api/noticias-globales', function () {
    return \App\Models\Noticia::where('es_global', true)
        ->orderBy('fecha', 'desc')
        ->get();
});

Route::get('/api/noticias-ecuador', function () {
    return \App\Models\Noticia::whereHas('pais', function ($query) {
        $query->where('slug', 'ecuador');
    })->orderBy('fecha', 'desc')->get();
});

Route::get('/api/noticias-bolivia', function () {
    return \App\Models\Noticia::whereHas('pais', function ($query) {
        $query->where('slug', 'bolivia');
    })->orderBy('fecha', 'desc')->get();
});

Route::get('/admin/noticias', [NoticiaController::class, 'listado'])
    ->middleware(['auth'])
    ->name('noticias.listado');

Route::get('/editar-noticia/{slug}', [NoticiaController::class, 'edit'])
    ->middleware(['auth'])
    ->name('noticias.edit');

Route::put('/editar-noticia/{slug}', [NoticiaController::class, 'update'])
    ->middleware(['auth'])
    ->name('noticias.update');

Route::delete('/eliminar-noticia/{slug}', [NoticiaController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('noticias.destroy');

Route::prefix('api')->group(function () {
    Route::get('/categorias', [CategoriaController::class, 'index']);
    Route::get('/paises', [PaisController::class, 'index']);
    Route::get('/provincias/{pais}', [ProvinciaController::class, 'index']);
    Route::get('/emprendimientos/categoria/{categoria}', [CategoriaController::class, 'apiEmprendimientosByCategoria']);
    Route::get('/emprendimientos/categoria-ecuador/{categoria}', [CategoriaController::class, 'apiEmprendimientosByCategoriaEcuador']);
    Route::get('/emprendimientos/categoria-bolivia/{categoria}', [CategoriaController::class, 'apiEmprendimientosByCategoriaBolivia']);
    Route::get('/emprendimientos/provincia/{codigo}', [ProvinciaController::class, 'apiEmprendimientosByProvincia']);
    Route::get('/emprendimientos/provinciaBolivia/{codigo}', [ProvinciaController::class, 'apiEmprendimientosByProvinciaBolivia']);

    Route::get('/filtros/categoria/{categoria}', [CategoriaController::class, 'apiFiltrosByCategoria']);
    Route::get('/filtros/categoria-ecuador/{categoria}', [CategoriaController::class, 'apiFiltrosByCategoriaEcuador']);
    Route::get('/filtros/categoria-bolivia/{categoria}', [CategoriaController::class, 'apiFiltrosByCategoriaBolivia']);

    Route::get('/filtros/provincia/{codigo}', [ProvinciaController::class, 'apiFiltrosByProvincia']);
    Route::get('/filtros/provinciaBolivia/{codigo}', [ProvinciaController::class, 'apiFiltrosByProvinciaBolivia']);


});
Route::get('/admin/emprendimientos', [EmprendimientoController::class, 'listado'])
    ->middleware(['auth'])
    ->name('emprendimientos.listado');

require __DIR__.'/auth.php';
