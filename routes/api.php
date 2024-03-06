<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\CompanyProductsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Rutas de autenticación
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

// Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
//     ->middleware('guest')
//     ->name('password.email');

// Route::post('/reset-password', [NewPasswordController::class, 'store'])
//     ->middleware('guest')
//     ->name('password.store');

// Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
//     ->middleware(['auth', 'signed', 'throttle:6,1'])
//     ->name('verification.verify');

// Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//     ->middleware(['auth', 'throttle:6,1'])
//     ->name('verification.send');

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/', [HomeController::class, 'index']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Route::middleware('company')->group(function () {
//     Route::get('/products', [ProductController::class, 'index']);
//     Route::get('/products/{id}', [ProductController::class, 'show']);
//     Route::post('/products', [ProductController::class, 'store']);
//     Route::put('/products/{id}', [ProductController::class, 'update']);
//     Route::delete('/products/{id}', [ProductController::class, 'destroy']);
// });

Route::middleware(['auth:sanctum', 'Admin'])->group(function () {
    Route::get('/products', [AdminProductsController::class, 'index']);
    Route::get('/products/{id}', [AdminProductsController::class, 'show']);
    Route::post('/products', [AdminProductsController::class, 'store']);
    Route::put('/products/{id}', [AdminProductsController::class, 'update']);
    Route::delete('/products/{id}', [AdminProductsController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'User'])->group(function () {
   
});

Route::middleware(['auth:sanctum', 'Company'])->group(function () {
    Route::get('/company/products', [CompanyProductsController::class, 'index']);
    Route::get('/company/products/{id}', [CompanyProductsController::class, 'show']);
    Route::post('/company/products', [CompanyProductsController::class, 'store']);
    Route::put('/company/products/{id}', [CompanyProductsController::class, 'update']);
    Route::delete('/company/products/{id}', [CompanyProductsController::class, 'destroy']);
});

