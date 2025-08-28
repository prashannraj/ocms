<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\OfficeSettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\EnquiryFormController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/otp', [OtpController::class, 'show'])->name('otp.show');
Route::post('/otp', [OtpController::class, 'verify'])->name('otp.verify');
Route::get('/otp/resend', [OtpController::class, 'resend'])->name('otp.resend');


Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/office-settings', [OfficeSettingController::class, 'edit'])->name('office_settings.edit');
    Route::post('/office-settings', [OfficeSettingController::class, 'update'])->name('office_settings.update');
    Route::get('/office-setting', [OfficeSettingController::class, 'index'])->name('office.setting');
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
});

Route::prefix('admin/enquiryform')->name('enquiryform.')->group(function () {
    Route::get('/', [EnquiryFormController::class, 'index'])->name('index');
    Route::get('/create', [EnquiryFormController::class, 'create'])->name('create');
    Route::post('/store', [EnquiryFormController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [EnquiryFormController::class, 'edit'])->name('edit');
    Route::put('/{id}', [EnquiryFormController::class, 'update'])->name('update');
    Route::get('/display/{uuid}', [EnquiryFormController::class, 'display'])->name('display');
    Route::post('/fillup/{uuid}', [EnquiryFormController::class, 'fillup'])->name('fillup');
});


require __DIR__.'/auth.php';
