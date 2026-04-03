<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTypeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render("Dashboard");
})->name('dashboard');

Route::prefix('project')->as('project.')->controller(ProjectController::class)->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::get('{id}', 'show')->whereNumber('id')->name('show');
    Route::get('edit/{id}', 'edit')->whereNumber('id')->name('edit');
    Route::post('', 'store')->name('store');
    Route::put('/{id}', 'update')->whereNumber('id')->name('update');
    Route::delete('/{id}', 'destroy')->whereNumber('id')->name('destroy');

    Route::prefix('type')->as('type.')->controller(ProjectTypeController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('', 'store')->name('store');
        Route::put('/{id}', 'update')->whereNumber('id')->name('update');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('destroy');
    });
});
