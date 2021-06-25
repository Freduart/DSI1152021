<?php


use App\Http\Controllers\Admins\AdminDashboardController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\EncargadoFacultadController;
use App\Http\Controllers\FacultadController;
use App\Http\Controllers\EncargadoEscuelaController;
use App\Http\Controllers\VerificarCuentaController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\RolController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UsersController;

use App\Mail\CredencialesMailable;
use Illuminate\Support\Facades\Mail;

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

Route::resource('usuarios', UsersController::class);
Route::resource('roles', RolController::class);

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

// Route::put('carreras/cambiar/{estado}', function($carrera, $estado){
//     $carrera->estado_carrera = $estado;
//     return $carrera->all();
// })->name('carreras.updateStatus');
Route::resource('encargadosfacultad', EncargadoFacultadController::class);
Route::resource('facultades', FacultadController::class);

Route::resource('encargadosescuela', EncargadoEscuelaController::class);

Route::resource('verificarcuenta', VerificarCuentaController::class);
Route::resource('instituciones', InstitucionController::class);
//Route::delete('verificarcuenta/{id}', [VerificarCuentaController::class, 'id'])->name('verificarcuenta.eliminar');
Route::get('credenciales', function (){
  $details = [
    'usuario' => 'usuariooo',
    'contrasena' => 'contra'
  ];
  //$correo = new CredencialesMailable;
  Mail::to('jganuzaramírez@gmail.com')->send(new CredencialesMailable($details));
  return "mensaje enviado";
});