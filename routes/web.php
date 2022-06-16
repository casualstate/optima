<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\Authentication\AuthController;
use Illuminate\Notifications\Action;
use Spatie\Activitylog\Models\Activity;

Route::get('/get-permintaan', [PermintaanController::class, 'getDataPermintaan'])->name('get_permintaan');
Route::get('/detail-permintaan', [PermintaanController::class, 'detailPermintaan'])->name('detail_permintaan');

Route::group(['middleware' => 'auth'], function(){

    Route::get('/', [PermintaanController::class, 'pagePermintaan'])->name('page_permintaan');
    Route::get('/input-permintaan', [PermintaanController::class, 'inputPermintaan'])->name('input_permintaan');
    Route::post('/simpan-permintaan', [PermintaanController::class, 'simpanPermintaan'])->name('simpan_permintaan');

    Route::get('/project', [ProjectController::class, 'inputProject'])->name('input_project');
    Route::post('/simpan-project', [ProjectController::class, 'simpanProject'])->name('simpan_project');
    Route::post('/update-project', [ProjectController::class, 'updateProject'])->name('update_project');
    Route::get('/get-project', [ProjectController::class, 'getProject'])->name('get_project');

    Route::post('/update-progress', [MitraController::class, 'updateProgress'])->name('update_progress');

    Route::post('/simpan-rab', [ProjectController::class, 'simpanRab'])->name('simpan_rab');
    Route::get('/get-rab', [ProjectController::class, 'getRab'])->name('get-rab');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // logout

    Route::get('/mitra', [MitraController::class, 'pageMitra'])->name('page_mitra');
    Route::resource('users', '\App\Http\Controllers\UserController');


    Route::get('/log-activity', [LogActivityController::class, 'logActivity'])->name('log-activity');
});

Route::prefix('auth')->name('auth.')->group(function (){
    Route::get('/login', [AuthController::class, 'index'])->name('login'); // login view
    Route::post('/login-post', [AuthController::class, 'login'])->name('login-post');
});
