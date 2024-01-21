<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;

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

Route::get('/', function () {
    return view('welcome');
});
//verify email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
//end verify email

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//admin
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('dashboard', 'index')->name('admin.index');
            Route::get('logout', 'AdminLogout')->name('admin.logout');
            //admin profile
            Route::get('profile', 'AdminProfile')->name('admin.profile');
            Route::post('profile', 'AdminUpdateProfile')->name('admin.update.profile');
            //update password
            Route::get('change-password', 'AdminChangePassword')->name('admin.change_password');
            Route::post('change-password', 'AdminUpdatePassword')->name('admin.update_password');
        });
    });
});
//end admin

//vendor
Route::middleware(['auth', 'verified', 'role:vendor'])->group(function () {
    Route::prefix('vendor')->group(function () {

    });
});
//end vendor


//route login
//backend
Route::get('/admin/sign-in', [AdminController::class, 'SignIn'])->name('admin.sign_in');
Route::get('/admin/sign-up', [AdminController::class, 'SignUp'])->name('admin.sign_up');
//frontend
Route::get('/sign-up', [FrontendController::class, 'SignUp'])->name('customer.sign_up');
Route::get('/sign-in', [FrontendController::class, 'SignIn'])->name('customer.sign_in');


require __DIR__.'/auth.php';
