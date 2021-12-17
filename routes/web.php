<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('agent.')->namespace('Agent')->middleware(['auth', 'verified', 'user'])->group(function() {
   
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Agent\DashboardController::class,'index'])->name('dashboard');
    
    // Account
    Route::get('/account/profile', [App\Http\Controllers\Agent\AccountController::class,'profile'])->name('profile');
    Route::post('/account/profile', [App\Http\Controllers\Agent\AccountController::class,'saveProfile'])->name('profile.update');
    Route::get('/account/settings', [App\Http\Controllers\Agent\AccountController::class,'settings'])->name('settings');
    Route::post('/account/settings', [App\Http\Controllers\Agent\AccountController::class,'saveSettings'])->name('settings.update');
});

Route::name('admin.')->namespace('Admin')->prefix('admin')->middleware(['auth', 'user', 'admin'])->group(function() {
	
	// Users
	Route::get('/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users.index');
	Route::get('/users/{uuid}', [App\Http\Controllers\Admin\UsersController::class, 'view'])->name('users.view');
    
	
	//Batch Upload
	Route::get('/batch/uploadbatch', [App\Http\Controllers\Admin\BatchPostContentController::class, 'uploadbatch'])->name('batch.uploadbatch');
	Route::post('/batch/importcsv', [App\Http\Controllers\Admin\BatchPostContentController::class, 'importcsv'])->name('batch.importcsv');
    
});
