<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTypeController;
use Illuminate\Support\Facades\Route;

/**
 * Auth
 * uri        - /*
 * prefix     - *
 * controller - AuthController
 */
Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'login')->name('login');
});

Route::middleware('auth')->group(function () {
    Route::delete('/', [AuthController::class, 'logout'])->name('logout');

    /**
     * Dashbaord
     * uri        - psm/*
     * prefix     - dashboard.*
     * controller - DashboardController
     */
    Route::prefix('dashboard')->as('dashboard.')->controller(DashboardController::class)->group(function () {
       Route::get('', 'index')->name('index');
    });

     /**
     * Project
     * uri        - psm/project/*
     * prefix     - project.*
     * controller - ProjectController
     */
    Route::prefix('project')->as('project.')->controller(ProjectController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('{id}', 'show')->whereNumber('id')->name('show');
        Route::get('edit/{id}', 'edit')->whereNumber('id')->name('edit');
        Route::post('', 'store')->name('store');
        Route::put('/{id}', 'update')->whereNumber('id')->name('update');
        Route::delete('/{id}', 'destroy')->whereNumber('id')->name('destroy');
    
        /**
         * Project Type
         * uri        - psm/project/type/*
         * prefix     - project.type.*
         * controller - ProjectTypeController
         */
        Route::prefix('type')->as('type.')->controller(ProjectTypeController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('', 'store')->name('store');
            Route::put('/{id}', 'update')->whereNumber('id')->name('update');
            Route::delete('/{id}', 'destroy')->whereNumber('id')->name('destroy');
        });
    });
});

