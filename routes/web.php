<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\OfficeSettingController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/otp', [OtpController::class, 'show'])->name('otp.show');
Route::post('/otp', [OtpController::class, 'verify'])->name('otp.verify');

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/office-settings', [OfficeSettingController::class, 'edit'])->name('office_settings.edit');
    Route::post('/office-settings', [OfficeSettingController::class, 'update'])->name('office_settings.update');
});
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
});


require __DIR__.'/auth.php';
