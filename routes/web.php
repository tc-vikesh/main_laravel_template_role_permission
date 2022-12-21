<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UsersController;

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
    // return view('welcome');
    return redirect()->route('admin.dashboard');
});
Route::group(['prefix' => 'admin', 'middleware' => ['web']], function () {
    // Auth::routes();

    // Login Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login/submit', [LoginController::class, 'login'])->name('admin.login.submit');

    /**
     * Dashboard Routes
     * Logout Routes
     */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');
    Route::post('/logout/submit', [LoginController::class, 'logout'])->name('admin.logout.submit')->middleware('auth');
    
    Route::group(['middleware' => ['auth','permission']], function() {
        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function() {
            Route::get('/', [UsersController::class, 'index'])->name('admin.users.index');
            Route::get('/create', [UsersController::class, 'create'])->name('admin.users.create');
            Route::post('/create', [UsersController::class, 'store'])->name('admin.users.store');
            Route::get('/{user}/show', [UsersController::class, 'show'])->name('admin.users.show');
            Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
            Route::patch('/{user}/update', [UsersController::class, 'update'])->name('admin.users.update');
            Route::delete('/{user}/delete', [UsersController::class, 'destroy'])->name('admin.users.destroy');
        });
         /**
         * Roles Routes
         * Permissions Routes
         */
        Route::resource('roles', RolesController::class, ['names' => 'admin.roles']);
        
        // Route::resource('permissions', PermissionsController::class, ['names' => 'admin.permissions']);
    });


});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

