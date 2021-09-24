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
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\VerificarActividadesController;
use App\Http\Controllers\FinalizarActividadesController;
use App\Http\Controllers\EstablecerHAController;
use App\Http\Controllers\ServicioSocialController;

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

Route::resource('usuarios', UsersController::class)->middleware(['auth:sanctum','verified']);
Route::resource('roles', RolController::class)->middleware(['auth:sanctum','verified']);

Route::get('/', function () {
    return Inertia::render('Admins/Dashboard', [
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

Route::resource('carreras', CarreraController::class)->middleware(['auth:sanctum','verified']);

// Route::put('carreras/cambiar/{estado}', function($carrera, $estado){
//     $carrera->estado_carrera = $estado;
//     return $carrera->all();
// })->name('carreras.updateStatus');
Route::resource('encargadosfacultad', EncargadoFacultadController::class)->middleware(['auth:sanctum','verified']);
Route::resource('facultades', FacultadController::class)->middleware(['auth:sanctum','verified']);

Route::resource('encargadosescuela', EncargadoEscuelaController::class)->middleware(['auth:sanctum','verified']);

Route::resource('verificarcuenta', VerificarCuentaController::class)->middleware(['auth:sanctum','verified']);
Route::resource('instituciones', InstitucionController::class)->middleware(['auth:sanctum','verified']);
Route::resource('actividades', ActividadesController::class)->middleware(['auth:sanctum','verified']);


Route::resource('solicitudesestudiante', SolicitudController::class)->middleware(['auth:sanctum','verified']);

Route::resource('solicitudes', SolicitudesController::class)->middleware(['auth:sanctum','verified']);

Route::resource('verificaractividades', VerificarActividadesController::class)->middleware(['auth:sanctum','verified']);

Route::resource('establecerha', EstablecerHAController::class)->middleware(['auth:sanctum','verified']);

Route::resource('finalizaractividades', FinalizarActividadesController::class)->middleware(['auth:sanctum','verified']);

Route::resource('bitacora', BitacoraController::class)->middleware(['auth:sanctum','verified']);

Route::resource('serviciossociales', ServicioSocialController::class)->middleware(['auth:sanctum', 'verified']);

Route::get('actividades/{proyecto_social_id}', ['as' => 'actividades', 'uses' => 'ActividadesController@show']);

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