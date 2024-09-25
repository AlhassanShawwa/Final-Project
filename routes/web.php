<?php

use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\LapController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestController;
use App\Models\Lap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::prefix(LaravelLocalization::setLocale())->group(function () {





Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Auth::routes();
        route::prefix('dashboard')->group(function () {
            // Route::get('/admin', function () {
            //     return view('dashboard.admin.index');
            // })->middleware('auth:admin');
            route::prefix('/admin')->middleware('auth:admin')->group(function () {
                Route::get('/', function () {
                    return view('dashboard.admin.index');
                })->name('dashboard');
                route::resource('doctors', DoctorController::class);
                route::post('/doctors/{id}/update-status', [DoctorController::class, 'updateStatus'])->name('doctors.updateStatus');
                route::get('/doctors/{id}/get-status', [DoctorController::class, 'getStatus'])->name('doctors.getStatus');
                route::resource('departments', DepartmentController::class);
                route::get('/departments/{id}', [DoctorController::class, 'show_doctors'])->name('doctors.show_doctors');
                Route::resource('services', ServiceController::class);
                route::post('/services/{id}/update-status', [ServiceController::class, 'updateStatus'])->name('services.updateStatus');
                route::get('/services/{id}/get-status', [ServiceController::class, 'getStatus'])->name('services.getStatus');
                Route::resource('group-services', GroupController::class);
                Route::get('group-services/get_services/{id}', [GroupController::class, 'get_services'])->name('getServices');
                route::post('/group-services/{id}/update-status', [GroupController::class, 'updateStatus'])->name('group-services.updateStatus');
                route::get('/group-services/{id}/get-status', [GroupController::class, 'getStatus'])->name('group-services.getStatus');
                route::resource('patients', PatientController::class);
                route::resource('insurances', InsuranceController::class);
                route::post('/insurances/{id}/update-status', [InsuranceController::class, 'updateStatus'])->name('insurances.updateStatus');
                route::get('/insurances/{id}/get-status', [InsuranceController::class, 'getStatus'])->name('insurances.getStatus');
                route::resource('ambulances', AmbulanceController::class);
                route::resource('drivers', DriverController::class);
                route::post('/drivers/{id}/update-status', [DriverController::class, 'updateStatus'])->name('drivers.updateStatus');
                route::get('/drivers/{id}/get-status', [DriverController::class, 'getStatus'])->name('drivers.getStatus');
                route::resource('pharmacists', PharmacistController::class);
                route::resource('pharmacies', PharmacyController::class);
                route::resource('laps', LapController::class);
                route::resource('medicines', MedicineController::class);
                Route::post('/medicines/import', [MedicineController::class, 'import'])->name('medicines.import');
                route::resource('tests', TestController::class);
            });

            Route::get('/doctor', function () {
                return view('dashboard.doctor.index2');
            })->middleware('auth:doctor');

            Route::get('/patient', function () {
                return view('dashboard.patient.index2');
            })->middleware('auth');

            // route::prefix('doctor')->group(function () {
            //     Route::get('/', [App\Http\Controllers\Doctor\Dashboard\DoctorDashboardController::class, 'index'])->name('doctor.dashboard')->middleware('auth:doctor');
            // });
            // route::prefix('patient')->group(function () {
            //     Route::get('/', [App\Http\Controllers\Patient\Dashboard\PatientDashboardController::class, 'index'])->name('patient.dashboard')->middleware('auth:web');
            // });
        });
        Route::get('/', function () {
            return view('web.index');
        });


        // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    }
);