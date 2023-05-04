<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});
Route::get('/', function () {
    if(\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('dashboard');
    }
    else{
        return redirect()->route('login');
    }
});
// url to show vehicle info publicly through QR code
Route::get('/vehicle-url/{id}', [\App\Http\Controllers\VehicleController::class, 'vehicleUrlInfo'])->name('vehicle-url');

Route::get('/vms_code', [\App\Http\Controllers\DashboardController::class, 'vCode'])->name('vms_code');

/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});*/

//all routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    //vehicle crud
    Route::resource('vehicle', \App\Http\Controllers\VehicleController::class);
    Route::get('/search_vehicles/{status}', [\App\Http\Controllers\VehicleController::class, 'searchVehicle'])->name('search_vehicles');

    Route::get('/vehicle_import', [\App\Http\Controllers\VehicleController::class, 'importVehicle'])->name('vehicle_import');
    Route::post('/add_import_vehicle', [\App\Http\Controllers\VehicleController::class, 'addImportedVehicle'])->name('add_import_vehicle');
    Route::get('/print-sticker/{id}', [\App\Http\Controllers\VehicleController::class, 'printSticker'])->name('print-sticker');


    //departments crud
    Route::resource('department', \App\Http\Controllers\DepartmentsController::class);

    //for reporting
    Route::resource('reports', \App\Http\Controllers\ReportController::class);
});
