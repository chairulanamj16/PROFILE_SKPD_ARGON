<?php

use App\Http\Controllers\API\V1\OfficeController;
use App\Http\Controllers\API\V1\PejabatTapinController;
use App\Http\Controllers\API\V1\PostController;
use App\Http\Controllers\API\V1\PPIDController;
use App\Http\Controllers\API\V1\PublikasiController;
use App\Http\Controllers\API\V1\VisitorController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::group(['middleware' => ['tokenAPI', 'visitor']], function () {
        Route::get('news', [PostController::class, 'news']);
        Route::get('news/{post:uuid}', [PostController::class, 'detail']);
        Route::get('new-search', [PostController::class, 'search']);
        Route::get('publikasi/{subdomain}', [PublikasiController::class, 'publikasi']);
        Route::get('ppid', [PPIDController::class, 'ppid']);
        Route::get('ppid/top-download', [PPIDController::class, 'byTopDownload']);
        Route::get('ppid/filter', [PPIDController::class, 'byFilter']);
        Route::get('ppid/{ppid:uuid}/detail', [PPIDController::class, 'detail']);
        Route::get('ppid/{ppid:uuid}/download-file', [PPIDController::class, 'download_file']);
        Route::get('ppid/count', [PPIDController::class, 'count']);
        Route::get('offices', [OfficeController::class, 'offices']);
        Route::get('office/{offices:subdomain}', [OfficeController::class, 'office']);
        Route::get('office/{offices:subdomain}/galleries', [OfficeController::class, 'galleries']);
        Route::get('top-office', [OfficeController::class, 'top_office']);
        Route::get('office-galleries', [OfficeController::class, 'office_galleries']);
        Route::get('office-galleries-foto', [OfficeController::class, 'office_galleries_foto']);

        Route::get('/pejabat-tapin/{jabatan}/detail', [PejabatTapinController::class, 'detail']);
    });

    Route::group(['middleware' => ['tokenAPI']], function () {
        Route::get('/visitor/{date}', [VisitorController::class, 'visitor']);
    });
});
