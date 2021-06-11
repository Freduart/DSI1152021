<?php


use App\Http\Controllers\Admins\AdminDashboardController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\CarreraController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
   // return Inertia::render('Dashboard');
   return Inertia::render('Admins/Dashboard');
})->name('dashboard');
// ->middleware(['auth:sanctum','verified']);

Route::prefix('admin')->name('admin')->middleware(['auth:sanctum','verified'])->group(function()
{
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
});

Route::resource('estudiantes', EstudianteController::class);
// Route::get('/formEstudiante', [EstudianteController::class, 'create'])->name('formEstudiante');
// Route::get('/findCarrerabyFacultad/{id}?', [EstudianteController::class, 'findCarrerasByFacultad', 'id' => null])->name('findCarreraByFac');

Route::resource('carreras', CarreraController::class);