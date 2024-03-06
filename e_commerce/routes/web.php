<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductAttributeController;

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

//admin
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () {
    Route::get('dashboard', 'index')->name('index');
    Route::get('logout', 'AdminLogout')->name('logout');
    //admin profile
    Route::get('profile', 'AdminProfile')->name('profile');
    Route::post('profile', 'AdminUpdateProfile')->name('update.profile');
    //update password
    Route::get('change-password', 'AdminChangePassword')->name('change_password');
    Route::post('change-password', 'AdminUpdatePassword')->name('update_password');


    //--routes resource

    //router categories
    Route::resource('categories', CategoryController::class);
    Route::prefix('categories')->name('categories.')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

    //router products
    Route::resource('products', ProductController::class);
    Route::prefix('products')->name('products.')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
    });

    //product attributes
    Route::resource('product-attributes', ProductAttributeController::class);
    Route::prefix('product-attributes')->name('product_attr.')->controller(ProductAttributeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('edit-color/{id}', 'edit_color')->name('edit_color');
        Route::get('edit-size/{id}', 'edit_size')->name('edit_size');
        Route::put('update-color/{id}', 'update_color')->name('update_color');
        Route::put('update-size/{id}', 'update_size')->name('update_size');
        Route::delete('destroy-color/{id}', 'destroy_color')->name('destroy_color');
        Route::delete('destroy-size/{id}', 'destroy_size')->name('destroy_size');
    });
});
//end admin

//vendor
Route::middleware(['auth', 'verified', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {

});
//end vendor


//route login
//backend
Route::get('/admin/sign-in', [AdminController::class, 'SignIn'])->name('admin.sign_in');
Route::get('/admin/sign-up', [AdminController::class, 'SignUp'])->name('admin.sign_up');
//frontend
Route::get('/sign-up', [FrontendController::class, 'SignUp'])->name('customer.sign_up');
Route::get('/sign-in', [FrontendController::class, 'SignIn'])->name('customer.sign_in');


require __DIR__ . '/auth.php';
