<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/guidelines', [PublicController::class, 'guidelines'])->name('guidelines');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/contact-us', [PublicController::class, 'contactus'])->name('contactus');

// Appointments
Route::get('/medical-examination', [PublicController::class, 'medicalExamination'])->name('medicalExamination');
Route::post('/appointment/store', [PublicController::class, 'storeAppointment'])->name('appointment.store');
Route::get('/appointment/confirmation', [PublicController::class, 'confirmAppointment'])->name('appointment.confirmation');
Route::post('/payment/upload-proof', [PublicController::class, 'uploadPaymentProof'])->name('payment.uploadProof');
Route::get('/thank-you', [PublicController::class, 'thankYou'])->name('thank.you');


Route::get('medical-status-search', [PublicController::class, 'ViewMedicalReport'])->name('ViewMedicalReport');
Route::post('medical-results/save', [PublicController::class, 'saveMedicalReport'])->name('medicalResults.save');

// Special Appointments
Route::get('/special-appointment', [PublicController::class, 'specialAppointmentForm'])->name('special.appointment');
Route::post('/special-appointment/store', [PublicController::class, 'storeSpecialAppointment'])->name('special.store');
Route::get('/special-appointment/confirmation', [PublicController::class, 'confirmSpecialAppointment'])->name('special.confirm');
Route::post('/special-payment/upload-proof', [PublicController::class, 'uploadSpecialPaymentProof'])->name('special.payment.upload');
Route::get('/special-thank-you', [PublicController::class, 'specialThankYou'])->name('special.thankyou');

// medical center search
Route::get('medical-center-search', [PublicController::class, 'medicalCenters'])->name('ViewMedicalCenters');

// Route to handle the AJAX search
Route::post('/medical-centers/search', [PublicController::class, 'search'])->name('medical.search');

// Guest routes (login page + submit)
Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
});

// Protected admin area
Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // appointments
    Route::get('/appointments', [AdminController::class, 'allAppointments'])->name('appointments');
    Route::get('/appointments/data', [AdminController::class, 'appointmentsData'])->name('appointments.data');
    Route::get('/appointments/{id}/edit', [AdminController::class, 'editAppointment'])->name('appointments.edit');
    Route::post('/appointments/{id}/update', [AdminController::class, 'updateAppointment'])->name('appointments.update');
    Route::delete('/appointments/{id}', [AdminController::class, 'deleteAppointment'])->name('admin.appointments.delete');


    Route::get('/check-results', [AdminController::class, 'checkResults'])->name('checkResults');
    Route::get('/check-results/data', [AdminController::class, 'checkResultsData'])->name('checkResults.data');
    Route::delete('/check-results/{id}', [AdminController::class, 'deleteCheckResult'])->name('admin.checkResults.delete');
    Route::post('/check-results/read/{id}', [AdminController::class, 'markAsRead']);


    // special appointments
    Route::get('/special-appointments', [AdminController::class, 'allSpecialAppointments'])->name('special.appointments');
    Route::get('/special-appointments/data', [AdminController::class, 'specialAppointmentsData'])->name('special.appointments.data');
    Route::get('/special-appointments/{id}/edit', [AdminController::class, 'editSpecialAppointment'])->name('special.appointments.edit');
    Route::post('/special-appointments/{id}/update', [AdminController::class, 'updateSpecialAppointment'])->name('special.appointments.update');
    Route::delete('/special-appointments/{id}', [AdminController::class, 'deleteSpecialAppointment'])->name('special.appointments.delete');

});
