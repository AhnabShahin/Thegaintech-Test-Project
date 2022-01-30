<?php

use App\Http\Controllers\CustomAuthController;
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

Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [CustomAuthController::class, 'profile'])->name('profile');
Route::post('profile', [CustomAuthController::class, 'profileUpdate'])->name('profile-update');
Route::get('ProfileDestroy/{id}', [CustomAuthController::class, 'ProfileDestroy'])->name('profile-destroy');
Route::post('ProfileChange/{id}', [CustomAuthController::class, 'ProfileChange'])->name('profile-change');
Route::get('/', [CustomAuthController::class, 'index'])->name('home');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
