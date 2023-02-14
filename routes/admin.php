<?php

// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale() . '/admin'], function(){
    Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'getDashboard'])->name('admin.dashboard');
    Route::get('all-styles', [App\Http\Controllers\Admin\AdminController::class, 'getAllStyles'])->name('admin.get.all.style');
    Route::post('all-styles', [App\Http\Controllers\Admin\AdminController::class, 'searchStyles'])->name('admin.search.styles');
    Route::get('requests', [App\Http\Controllers\Admin\AdminController::class, 'getRequests'])->name('admin.requests');
    Route::get('login', [App\Http\Controllers\Admin\AdminController::class, 'getLogin'])->name('admin.get.login');
    Route::post('login', [App\Http\Controllers\Admin\AdminController::class, 'adminLogin'])->name('admin.login');
    Route::group(['prefix' => 'style'], function(){
        Route::get('show-style/{style_id}', [App\Http\Controllers\Admin\AdminController::class, 'showStyle'])->name('admin.show.style');
        Route::post('accept', [App\Http\Controllers\Admin\AdminController::class, 'acceptStyle'])->name('admin.accept.style');
        Route::post('delete', [App\Http\Controllers\Admin\AdminController::class, 'deleteStyle'])->name('admin.delete.style');
        Route::get('create', [\App\Http\Controllers\Admin\AdminController::class, 'getCreateStyle'])->name('admin.get.create.style');
        Route::post('create', [\App\Http\Controllers\Admin\AdminController::class, 'createStyle'])->name('admin.create.style');
    });
});