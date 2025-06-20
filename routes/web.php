<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\backend\v1\GaleriController;
use App\Http\Controllers\Backend\V1\PostController;
use App\Http\Controllers\backend\v1\PpidController;
use App\Http\Controllers\backend\v1\PublikasiController;
use App\Http\Controllers\backend\v1\SliderController;
use App\Http\Controllers\Backend\V1\SubdomainController;
use App\Http\Controllers\backend\v1\VideoController;
use App\Models\V1\Slider;

// Route untuk autentikasi
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
});

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

// Route::get('/', function () {
//     return view('layouts.app2');
// });

Route::middleware(['auth'])->group(function () {
    Route::prefix('subdomain')->group(function () {
        Route::get('/', [SubdomainController::class, 'index'])->name('subdomain')->middleware('permission:view_subdomain');
    });

    Route::group(['domain' => '{account}.' . env('APP_URL')], function () {
        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('post.index')->middleware('permission:view_post');
            Route::get('/create', [PostController::class, 'create'])->name('post.create')->middleware('permission:create_post');
        });
        Route::prefix('galeri')->group(function () {
            Route::get('/', [GaleriController::class, 'index'])->name('galeri.index')->middleware('permission:view_galeri');
        });
        Route::prefix('slider')->group(function () {
            Route::get('/', [SliderController::class, 'index'])->name('slider.index')->middleware('permission:view_slider');
        });
        Route::prefix('video')->group(function () {
            Route::get('/', [VideoController::class, 'index'])->name('video.index')->middleware('permission:view_video');
        });
        Route::prefix('publikasi')->group(function () {
            Route::get('/', [PublikasiController::class, 'index'])->name('publikasi.index')->middleware('permission:view_publikasi');
        });
        Route::prefix('ppid')->group(function () {
            Route::get('/', [PpidController::class, 'index'])->name('ppid.index')->middleware('permission:view_ppid');
        });
    });


    Route::prefix('users')->middleware(['permission:view_users|create_users|edit_users|delete_users'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware('permission:view_users');
        Route::post('/gridview', [UserController::class, 'gridview'])->name('users.gridview')->middleware('permission:view_users|edit_users|delete_users');
        Route::post('/', [UserController::class, 'store'])->name('users.store')->middleware('permission:create_users|edit_users');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:delete_users');
    });

    Route::prefix('menus')->middleware(['permission:view_menus|create_menus|edit_menus|delete_menus'])->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menus.index')->middleware('permission:view_menus');
        Route::post('/gridview', [MenuController::class, 'gridview'])->name('menus.gridview')->middleware('permission:view_menus');
        Route::post('/', [MenuController::class, 'store'])->name('menus.store')->middleware('permission:create_menus|edit_menus');
        Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy')->middleware('permission:delete_menus');
    });

    Route::prefix('roles')->middleware(['permission:view_roles|create_roles|edit_roles|delete_roles'])->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:view_roles');
        Route::post('/gridview', [RoleController::class, 'gridview'])->name('roles.gridview')->middleware('permission:view_roles');
        Route::post('/', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:create_roles|edit_roles');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:delete_roles');
    });

    Route::prefix('permissions')->middleware(['permission:view_permissions|create_permissions|edit_permissions|delete_permissions'])->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index')->middleware('permission:view_permissions');
        Route::post('/gridview', [PermissionController::class, 'gridview'])->name('permissions.gridview')->middleware('permission:view_permissions');
        Route::post('/', [PermissionController::class, 'store'])->name('permissions.store')->middleware('permission:create_permissions|edit_permissions');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('permission:delete_permissions');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
