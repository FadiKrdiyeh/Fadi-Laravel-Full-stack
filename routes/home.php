<?php

// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    // Route::post('home', [App\Http\Controllers\Styles\StyleController::class, 'searchStyles'])->name('search.styles');
    Route::post('home', [App\Http\Controllers\Styles\StyleController::class, 'searchStyles'])->name('live.search.styles');
    Route::group(['middleware' => 'auth'], function(){
        Route::get('styles/show-style/{style_id}', [App\Http\Controllers\Styles\StyleController::class, 'showStyle'])->name('show.style');
        Route::get('styles/create', [App\Http\Controllers\Styles\StyleController::class, 'getCreateStylePage'])->name('get.create.style');
        Route::post('styles/create', [App\Http\Controllers\Styles\StyleController::class, 'createStyle'])->name('create.style');
        Route::get('styles/rate', [App\Http\Controllers\Styles\StyleController::class, 'rateStyle'])->name('rate.styles');
        Route::post('styles/buy', [App\Http\Controllers\Styles\StyleController::class, 'buyStyle'])->name('buy.style');
        Route::get('home/wallet', [App\Http\Controllers\HomeController::class, 'getWallet'])->name('get.wallet');
    });
    Route::get('about-website', [\App\Http\Controllers\HomeController::class, 'getAboutWebsite'])->name('get.about.web');
    Route::get('about-developer', [\App\Http\Controllers\HomeController::class, 'getAboutDeveloper'])->name('get.about.developer');
    Route::get('themes', [\App\Http\Controllers\HomeController::class, 'getThemes'])->name('get.themes');

});