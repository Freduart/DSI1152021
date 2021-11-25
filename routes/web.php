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
use App\Http\Controllers\PeticionController;
use App\Http\Controllers\TipoServicioController;
use App\Http\Controllers\ConstanciaController;
use App\Http\Controllers\EstadisticasController;
// use App\Http\Controllers\FinalizarProyectoController;
use App\Http\Controllers\FinalizarServicioController;


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UsersController;

use App\Mail\CredencialesMailable;
use App\Mail\CorreossInstitucionMailable;
use App\Models\Bitacora;
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



Route::get('/', function () {
    return Inertia::render('Admins/home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('homepage');

// Route::middleware(['auth'])->group(function(){
//     Route::get('/usuarios/detalle/{id}', [UsersController::class, 'show'])->name('user.show')->middleware('permission:user.create');
// });



Route::resource('usuarios', UsersController::class)->middleware(['auth:sanctum','verified']);
Route::resource('roles', RolController::class)->middleware(['auth:sanctum','verified']);

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

Route::resource('carreras', CarreraController::class)->middleware(['auth:sanctum','verified']);


Route::resource('encargadosfacultad', EncargadoFacultadController::class)->middleware(['auth:sanctum','verified']);
Route::resource('facultades', FacultadController::class)->middleware(['auth:sanctum','verified']);

Route::resource('encargadosescuela', EncargadoEscuelaController::class)->middleware(['auth:sanctum','verified']);

Route::resource('verificarcuenta', VerificarCuentaController::class)->middleware(['auth:sanctum','verified']);
Route::resource('instituciones', InstitucionController::class);
Route::resource('actividades', ActividadesController::class)->middleware(['auth:sanctum','verified']);


Route::resource('solicitudesestudiante', SolicitudController::class)->middleware(['auth:sanctum','verified']);

Route::resource('solicitudes', SolicitudesController::class)->middleware(['auth:sanctum','verified']);

Route::resource('verificaractividades', VerificarActividadesController::class)->middleware(['auth:sanctum','verified']);

Route::resource('establecerha', EstablecerHAController::class)->middleware(['auth:sanctum','verified']);

Route::resource('finalizaractividades', FinalizarActividadesController::class)->middleware(['auth:sanctum','verified']);

Route::resource('bitacora', BitacoraController::class)->middleware(['auth:sanctum','verified']);

Route::resource('serviciossociales', ServicioSocialController::class)->middleware(['auth:sanctum', 'verified']);

Route::resource('constancia', ConstanciaController::class)->middleware(['auth:sanctum', 'verified']);

Route::resource('serviciofinalizado',FinalizarServicioController::class)->middleware(['auth:sanctum', 'verified']);


Route::get('actividades/{proyecto_social_id}', [ActividadesController::class, 'show'])->name('actividades');


Route::get('serviciossociales/{proyecto_social_id}', [ServicioSocialController::class, 'show'])->name('serviciossociales');


Route::get('serviciossociales/{proyecto_social_id}/estudiante/{estudiante_id}', [VerificarActividadesController::class, 'actividades'])->name('actividadesestudiante');

Route::get('serviciosdisponibles', [ServicioSocialController::class, 'serviciosDisponibles'])->name('serviciosDisponibles')->middleware(['auth:sanctum', 'verified']);


//Confirmacion de peticion se servicio social
//Supongo que confirmacion es el nombre de la ruta
/*Route::get('confirmacion', function(){

    
    $correossinsti = new CorreossInstitucionMailable;

    Mail::to('stefany19rodriguez@gmail.com')->send(new CorreossInstitucionMailable());
    return "Mensaje enviado";
});*/



//Ruta para el tipo de servicio social
Route::resource('tipoServicio', TipoServicioController::class)->only([
  'index','store','update','destroy'
]);

//Ruta de las peticiones
Route::resource('peticiones', PeticionController::class);

Route::get('estadisticas', [EstadisticasController::class, 'index'])->middleware(['auth:sanctum', 'verified'])->name('estadisticas');
Route::get('/bitacoras/pdf/{proyecto_social_id}', [BitacoraController::class, 'generarPDF'])->name('bitacora.pdf');
