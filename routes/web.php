<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;

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
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/about-us', [PublicController::class, 'about'])->name('about');

Route::get('/contact-us', [PublicController::class, 'contactus'])->name('contact');
Route::post('/contact-us', [PublicController::class, 'storecontact'])->name('contact.store');
Route::post('/feedback', [PublicController::class, 'storeFeedback'])->name('feedback.store');

// Appointments
Route::get('/wafid-appointment', [PublicController::class, 'medicalExamination'])->name('medicalExamination');
Route::post('/appointment/store', [PublicController::class, 'storeAppointment'])->name('appointment.store');
Route::get('/wafid-appointment/confirmation', [PublicController::class, 'confirmAppointment'])->name('appointment.confirmation');
Route::post('/payment/upload-proof', [PublicController::class, 'uploadPaymentProof'])->name('payment.uploadProof');
Route::get('/wafid-appointment/thank-you', [PublicController::class, 'thankYou'])->name('thank.you');


Route::get('medical-status-search', [PublicController::class, 'ViewMedicalReport'])->name('ViewMedicalReport');
Route::post('medical-results/save', [PublicController::class, 'saveMedicalReport'])->name('medicalResults.save');

// Special Appointments
Route::get('/wafid-special-appointment', [PublicController::class, 'specialAppointmentForm'])->name('special.appointment');
Route::post('/special-appointment/store', [PublicController::class, 'storeSpecialAppointment'])->name('special.store');
Route::get('/wafid-special-appointment/confirmation', [PublicController::class, 'confirmSpecialAppointment'])->name('special.confirm');
Route::post('/special-payment/upload-proof', [PublicController::class, 'uploadSpecialPaymentProof'])->name('special.payment.upload');
Route::get('/wafid-special-appointment/thank-you', [PublicController::class, 'specialThankYou'])->name('special.thankyou');

// medical center search
Route::get('medical-center-search', [PublicController::class, 'medicalCenters'])->name('ViewMedicalCenters');

// Route to handle the AJAX search
Route::post('/medical-centers/search', [PublicController::class, 'search'])->name('medical.search');

Route::get('navttc-takamol-booking', [PublicController::class, 'navtechform'])->name('navtechform');
Route::post('navttc-appointment', [PublicController::class, 'navtechstore'])->name('navtechform.store');
Route::get('navttc-thank-you', [PublicController::class, 'navtechThankYou'])->name('navtech.thankyou');

Route::get('navttc-confirmation', [PublicController::class, 'confirmNavtechAppointment'])->name('navtech.confirm');
Route::post('navtech-payment-upload', [PublicController::class, 'uploadNavtechPaymentProof'])->name('navtech.payment.upload');

// Tasheer Appointment Routes
Route::get('tasheer-saudi-visa-appointment', [PublicController::class, 'tasheerForm'])->name('tasheer.form');
Route::post('tasheer-appointment', [PublicController::class, 'tasheerStore'])->name('tasheer.store');
Route::get('tasheer-confirmation', [PublicController::class, 'confirmTasheerAppointment'])->name('tasheer.confirm');
Route::post('tasheer-payment-upload', [PublicController::class, 'uploadTasheerPaymentProof'])->name('tasheer.payment.upload');
Route::get('tasheer-thank-you', [PublicController::class, 'tasheerThankYou'])->name('tasheer.thankyou');

// Soft Skill Certificate Routes
Route::get('soft-skill-certificate', [PublicController::class, 'softSkillForm'])->name('softskill.form');
Route::post('soft-skill-certificate', [PublicController::class, 'softSkillStore'])->name('softskill.store');
Route::get('soft-skill-confirmation', [PublicController::class, 'softSkillConfirm'])->name('softskill.confirm');
Route::post('soft-skill-payment-upload', [PublicController::class, 'softSkillPaymentUpload'])->name('softskill.payment.upload');
Route::get('soft-skill-thank-you', [PublicController::class, 'softSkillThankYou'])->name('softskill.thankyou');

// Blogs Public Routes
Route::get('/blogs', [PublicController::class, 'blogs'])->name('public.blogs');
Route::get('/blogs/{slug}', [PublicController::class, 'blogDetails'])->name('public.blogs.details');

// City-wise Medical Centers (SEO)
Route::get('/medical-centers-in-{city}', [PublicController::class, 'medicalCentersByCity'])->name('public.medical.city');

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

    // Navtech Appointments
    Route::get('/navttc-appointments', [AdminController::class, 'allNavtechAppointments'])->name('navtech.appointments');
    Route::get('/navttc-appointments/data', [AdminController::class, 'navtechAppointmentsData'])->name('navtech.appointments.data');
    Route::get('/navttc-appointments/{id}/edit', [AdminController::class, 'editNavtechAppointment'])->name('navtech.appointments.edit');
    Route::post('/navttc-appointments/{id}/update', [AdminController::class, 'updateNavtechAppointment'])->name('navtech.appointments.update');
    Route::delete('/navttc-appointments/{id}', [AdminController::class, 'deleteNavtechAppointment'])->name('navtech.appointments.delete');

    // Tasheer Appointments Admin Routes
    Route::get('/tasheer-appointments', [AdminController::class, 'allTasheerAppointments'])->name('tasheer.appointments');
    Route::get('/tasheer-appointments/data', [AdminController::class, 'tasheerAppointmentsData'])->name('tasheer.appointments.data');
    Route::get('/tasheer-appointments/{id}/edit', [AdminController::class, 'editTasheerAppointment'])->name('tasheer.appointments.edit');
    Route::post('/tasheer-appointments/{id}/update', [AdminController::class, 'updateTasheerAppointment'])->name('tasheer.appointments.update');
    Route::delete('/tasheer-appointments/{id}', [AdminController::class, 'deleteTasheerAppointment'])->name('tasheer.appointments.delete');

    Route::get('/softskill-appointments', [AdminController::class, 'allSoftSkillAppointments'])->name('softskill.appointments');
    Route::get('/softskill-appointments/data', [AdminController::class, 'softSkillAppointmentsData'])->name('softskill.appointments.data');
    Route::get('/softskill-appointments/{id}/edit', [AdminController::class, 'editSoftSkillAppointment'])->name('softskill.appointments.edit');
    Route::post('/softskill-appointments/{id}/update', [AdminController::class, 'updateSoftSkillAppointment'])->name('softskill.appointments.update');
    Route::delete('/softskill-appointments/{id}', [AdminController::class, 'deleteSoftSkillAppointment'])->name('softskill.appointments.delete');

    // Contact Inquiries
    Route::get('/contacts', [AdminController::class, 'allContacts'])->name('contacts');
    Route::post('/contacts/data', [AdminController::class, 'contactsData'])->name('contacts.data');
    Route::post('/contacts/read/{id}', [AdminController::class, 'markContactAsRead'])->name('contacts.read');
    Route::delete('/contacts/{id}', [AdminController::class, 'deleteContact'])->name('contacts.delete');

    // Website Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Testimonials & Feedback within Settings context
    Route::post('/settings/testimonials', [SettingController::class, 'storeTestimonial'])->name('settings.testimonials.store');
    Route::delete('/settings/testimonials/{id}', [SettingController::class, 'deleteTestimonial'])->name('settings.testimonials.delete');
    Route::post('/settings/feedback/read/{id}', [SettingController::class, 'markFeedbackRead'])->name('settings.feedback.read');
    Route::delete('/settings/feedback/{id}', [SettingController::class, 'deleteFeedback'])->name('settings.feedback.delete');

    Route::prefix('payment-methods')->name('payment.methods.')->group(function () {
        Route::get('/', [AdminController::class, 'allPaymentMethods'])->name('index');
        Route::get('/data', [AdminController::class, 'paymentMethodsData'])->name('data');
        Route::get('/create', [AdminController::class, 'createPaymentMethod'])->name('create');
        Route::post('/store', [AdminController::class, 'storePaymentMethod'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'editPaymentMethod'])->name('edit');
        Route::post('/{id}/update', [AdminController::class, 'updatePaymentMethod'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'deletePaymentMethod'])->name('delete');
    });

    Route::get('appointment-fees', [AdminController::class, 'editfee'])->name('fees.edit');
    Route::post('appointment-fees/update', [AdminController::class, 'updatefee'])->name('fees.update');

    // FAQ Routes 
    Route::get('faq-list', [AdminController::class, 'showFaqPage'])->name('faqs.page');
    Route::get('faq-data-load', [AdminController::class, 'fetchFaqData'])->name('faqs.data');
    Route::get('faq-add', [AdminController::class, 'addFaqForm'])->name('faqs.add');
    Route::post('faq-save-entry', [AdminController::class, 'saveFaqEntry'])->name('faqs.save');
    Route::get('faq-edit-entry/{id}', [AdminController::class, 'editFaqForm'])->name('faqs.edit');
    Route::post('faq-update-entry/{id}', [AdminController::class, 'updateFaqEntry'])->name('faqs.update');
    Route::delete('faq-remove/{id}', [AdminController::class, 'removeFaqEntry'])->name('faqs.delete');

    // Profile Routes
    Route::get('/profile', [AdminController::class, 'editprofile'])->name('profile.edit');
    Route::put('/profile', [AdminController::class, 'updateprofile'])->name('profile.update');

    // Blog Categories
    Route::get('/blog-categories', [AdminController::class, 'blogCategories'])->name('blog.categories');
    Route::get('/blog-categories/data', [AdminController::class, 'blogCategoriesData'])->name('blog.categories.data');
    Route::post('/blog-categories/store', [AdminController::class, 'storeBlogCategory'])->name('blog.categories.store');
    Route::get('/blog-categories/{id}/edit', [AdminController::class, 'editBlogCategory'])->name('blog.categories.edit');
    Route::post('/blog-categories/{id}/update', [AdminController::class, 'updateBlogCategory'])->name('blog.categories.update');
    Route::delete('/blog-categories/{id}', [AdminController::class, 'deleteBlogCategory'])->name('blog.categories.delete');

    // Blogs
    Route::get('/blogs', [AdminController::class, 'blogs'])->name('blogs.index');
    Route::get('/blogs/data', [AdminController::class, 'blogsData'])->name('blogs.data');
    Route::get('/blogs/create', [AdminController::class, 'createBlog'])->name('blogs.create');
    Route::post('/blogs/store', [AdminController::class, 'storeBlog'])->name('blogs.store');
    Route::get('/blogs/{id}/edit', [AdminController::class, 'editBlog'])->name('blogs.edit');
    Route::post('/blogs/{id}/update', [AdminController::class, 'updateBlog'])->name('blogs.update');
    Route::delete('/blogs/{id}', [AdminController::class, 'deleteBlog'])->name('blogs.delete');

    // Medical Centers
    Route::prefix('medical-centers')->name('medical_centers.')->group(function () {
        Route::get('/', [AdminController::class, 'allMedicalCenters'])->name('index');
        Route::get('/data', [AdminController::class, 'medicalCentersData'])->name('data');
        Route::get('/create', [AdminController::class, 'createMedicalCenter'])->name('create');
        Route::post('/store', [AdminController::class, 'storeMedicalCenter'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'editMedicalCenter'])->name('edit');
        Route::post('/{id}/update', [AdminController::class, 'updateMedicalCenter'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'deleteMedicalCenter'])->name('delete');
    });

    // City Media Management
    Route::group(['prefix' => 'city-media', 'as' => 'city_media.'], function () {
        Route::get('/', [AdminController::class, 'cityMedia'])->name('index');
        Route::get('/data', [AdminController::class, 'cityMediaData'])->name('data');
        Route::get('/create', [AdminController::class, 'createCityMedia'])->name('create');
        Route::post('/store', [AdminController::class, 'storeCityMedia'])->name('store');
        Route::delete('/{id}', [AdminController::class, 'deleteCityMedia'])->name('delete');
    });
});
