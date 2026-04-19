<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Auth
 * uri        - /*
 * prefix     - *
 * controller - AuthController
 */
Route::middleware('guest')
     ->controller(AuthController::class)
     ->group(function () {
          Route::get('', 'index')->name('index');
          Route::post('', 'login')->name('login');
     });

Route::middleware('auth')
     ->group(function () {

          /**
           * Auth
           * uri        - /*
           * prefix     - *
           * controller - AuthController
           */
          Route::delete('', [AuthController::class, 'logout'])->name('logout');

          /**
           * Dashbaord
           * uri        - psm/*
           * prefix     - dashboard.*
           * controller - DashboardController
           */
          Route::prefix('dashboard')
               ->as('dashboard.')
               ->controller(DashboardController::class)
               ->group(function () {
                    Route::get('', 'index')->name('index');
               });

          /**
           * User
           * uri        - psm/user/*
           * prefix     - user.*
           * controller - UserController
           */
          Route::prefix('user')
               ->as('user.')
               ->controller(UserController::class)
               ->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('', 'store')->name('store');
                    Route::get('{id}', 'show')->whereNumber('id')->name('show');
                    Route::get('edit/{id}', 'edit')->whereNumber('id')->name('edit');
                    Route::get('request', 'request')->name('request');
                    Route::put('{id}', 'update')->whereNumber('id')->name('update');
                    Route::delete('{id}', 'destroy')->whereNumber('id')->name('destroy');
               });

          /**
           * Project
           * uri        - psm/project/*
           * prefix     - project.*
           * controller - ProjectController
           */
          Route::prefix('project')
               ->as('project.')
               ->controller(ProjectController::class)
               ->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::get('{id}', 'show')->whereNumber('id')->name('show');
                    Route::post('', 'store')->name('store');
                    Route::get('edit/{id}', 'edit')->whereNumber('id')->name('edit');
                    Route::put('{id}', 'update')->whereNumber('id')->name('update');
                    Route::delete('{id}', 'destroy')->whereNumber('id')->name('destroy');

                    /**
                     * Project Type
                     * uri        - psm/project/type/*
                     * prefix     - project.type.*
                     * controller - ProjectTypeController
                     */
                    Route::prefix('type')
                         ->as('type.')
                         ->controller(ProjectTypeController::class)
                         ->group(function () {
                              Route::get('', 'index')->name('index');
                              Route::post('', 'store')->name('store');
                              Route::put('{id}', 'update')->whereNumber('id')->name('update');
                              Route::delete('{id}', 'destroy')->whereNumber('id')->name('destroy');
                         });

                    /**
                     * Project Task
                     * uri        - psm/project/{project_id}/task/*
                     * prefix     - project.task.*
                     * controller - TaskController
                     */
                    Route::prefix('{project_id}/task')
                         ->as('task.')
                         ->whereNumber('project_id')
                         ->controller(TaskController::class)
                         ->group(function () {
                              Route::get('create', 'create')->name('create');
                              Route::post('', 'store')->name('store');
                              Route::get('edit/{id}', 'edit')->whereNumber('id')->name('edit');
                              Route::put('{id}', 'update')->whereNumber('id')->name('update');
                              Route::delete('{id}', 'destroy')->whereNumber('id')->name('destroy');
                         });
               });

          /**
           * Task
           * uri        - psm/task/*
           * prefix     - task.*
           * controller - TaskController
           */
          Route::prefix('task')
               ->as('task.')
               ->controller(TaskController::class)
               ->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('{id}', 'show')->whereNumber('id')->name('show');
                    Route::patch('{id}', 'change')->whereNumber('id')->name('change');
               });

          /**
           * Team
           * uri        - psm/team/*
           * prefix     - team.*
           * controller - TeamController
           */
          Route::prefix('team')
               ->as('team.')
               ->controller(TeamController::class)
               ->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('', 'store')->name('store');
                    Route::get('{id}', 'show')->whereNumber('id')->name('show');
                    Route::get('edit/{id}', 'edit')->whereNumber('id')->name('edit');
                    Route::put('{id}', 'update')->whereNumber('id')->name('update');
                    Route::delete('{id}', 'destroy')->whereNumber('id')->name('destroy');

                    /**
                     * Team
                     * uri        - psm/team/{team_id}/member/*
                     * prefix     - team.member.*
                     * controller - TeamMemberController
                     */
                    Route::prefix('{team_id}/member')
                         ->as('member.')
                         ->whereNumber('team_id')
                         ->controller(TeamMemberController::class)
                         ->group(function () {
                              Route::delete('{id}', 'destroy')->whereNumber('id')->name('destroy');
                         });
               });

          /**
           * Setting
           * uri        - psm/setting/*
           * prefix     - setting.*
           * controller - SettingController
           */
          Route::prefix('setting')
               ->as('setting.')
               ->controller(SettingController::class)
               ->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('/general', 'general')->name('general');
               });
     });
