<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\DokterController;


/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
// Route::get('/', function () {
//     return view('welcome');
// });
// Routing halaman utama frontend (pakai folder frontend)
Route::view('/', 'frontend.index')->name('home');
Route::view('/about', 'frontend.about')->name('about');
Route::view('/causes', 'frontend.causes')->name('causes');
Route::view('/diagnosa', 'frontend.diagnosa')->name('diagnosa');
Route::view('/appointment', 'frontend.appointment')->name('appointment');
Route::view('/team', 'frontend.team')->name('team');
Route::view('/payment', 'frontend.payment')->name('payment');
Route::view('/contact', 'frontend.contact')->name('contact');
Route::view('/404', 'frontend.404')->name('404');

// AppointmentController
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store'); // Untuk menyimpan appointment dari form
Route::get('/admin/appointments/{id}', [AppointmentController::class, 'show'])->name('admin.appointments.show'); // (Opsional) Detail per appointment
Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointment.create');
Route::get('/appointment/{id}/payment', [AppointmentController::class, 'payment'])->name('appointment.payment');
Route::post('/appointment/{id}/pay', [AppointmentController::class, 'pay'])->name('appointment.pay');

Route::get('/payment', [AppointmentController::class, 'paymentForm'])->name('appointment.payment.form');
Route::post('/payment', [AppointmentController::class, 'paymentByEmail'])->name('appointment.payment.email');
Route::post('/payment/pay/{id}', [AppointmentController::class, 'pay'])->name('appointment.pay');
Route::get('/payment/invoice/{id}', [AppointmentController::class, 'invoice'])->name('appointment.payment.invoice');


// HomeController
Route::get('/', [HomeController::class, 'index']);
Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Payment
Route::get('/appointment/{id}/payment', [AppointmentController::class, 'payment'])->name('appointment.payment');
Route::post('/appointment/{id}/pay', [AppointmentController::class, 'pay'])->name('appointment.pay');

// DiagnosaController
Route::middleware(['role:dokter'])->group(function () {
Route::get('/diagnosa/create', [DiagnosaController::class, 'create'])->name('diagnosa.create');
Route::get('/appointments', [AppointmentController::class, 'index']);
Route::get('/dokters', [DokterController::class, 'index']);
});

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/diagnosa/create', [DiagnosaController::class, 'create'])->name('diagnosa.create');
    Route::post('/diagnosa', [DiagnosaController::class, 'store'])->name('diagnosa.store');
});
