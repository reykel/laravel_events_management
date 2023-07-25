<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExecutiveController;
use App\Http\Controllers\TaskActivityListController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TransportationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AgendaController;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/event-policy', [DashboardController::class, 'policy'])->name('event_policy');
Route::get('/contact', [DashboardController::class, 'contact'])->name('contact');
Route::get('/agenda', [DashboardController::class, 'agenda'])->name('agenda');
Route::post('/executives', [ExecutiveController::class, 'store'])->name('executives_create');
Route::get('/register-success', [ExecutiveController::class, 'success'])->name('register_success');

Route::get('/verify-code', [UserController::class, 'verify'])->name('verify_code');
Route::post('/check-code', [UserController::class, 'check'])->name('check_code');
Route::get('/user/unauthorized', [UserController::class, 'unauthorized'])->name('unauthorized');
Route::get('/user/unauthorized2', [UserController::class, 'unauthorized2'])->name('unauthorized2');
Route::get('/user/registered', [UserController::class, 'registerSuccess'])->name('register_success');

/***************       Admin Routes         *****************/
Route::group(['middleware' => ['double.auth']], function () {
    /**** Executives routes ***********/
    Route::get('/executives', [ExecutiveController::class, 'index'])->name('executives');
    Route::get('/executives-list', [ExecutiveController::class, 'list'])->name('executives_list');
    Route::get('/executives/details/{id}', [ExecutiveController::class, 'show'])->name('executives_show');
    Route::get('/executives/export', [ExecutiveController::class, 'export'])->name('executives_export');
    Route::get('/executives/{id}', [ExecutiveController::class, 'edit'])->name('executives_edit');
    Route::post('/executives/remove/{id}', [ExecutiveController::class, 'destroy'])->name('executives_delete');
    Route::post('/executives/update/{id}', [ExecutiveController::class, 'update'])->name('executives_update');

    /**** Transportation routes ***********/
    Route::get('/transportations', [TransportationController::class, 'index'])->name('transportations');
    Route::post('/transportations', [TransportationController::class, 'store'])->name('transportations_create');
    Route::get('/transportations/{id}', [TransportationController::class, 'show'])->name('transportations_show');
    Route::put('/transportations/{id}', [TransportationController::class, 'update'])->name('transportations_edit');
    /**** Task and activity routes ***********/
    Route::resource('/task', TaskController::class);
    Route::put('/task/{id}/driver-update', [TaskController::class, 'driverUpdateTask'])->name('driver_update_task');
    Route::resource('/activity', ActivityController::class);
    Route::put('/activity/{id}/driver-update', [ActivityController::class, 'driverUpdateActivity'])->name('driver_update_activity');
    /**** Other routes ***********/
    Route::get('/driver-list', [TaskActivityListController::class, 'index'])->name('driver_list');
    Route::get('/driver-accept/{id}', [UserController::class, 'accept'])->name('driver_accept');
    Route::get('/driver-reject/{id}', [UserController::class, 'reject'])->name('driver_reject');


    Route::get('/tasks/export', [TaskController::class, 'export'])->name('tasks_export');
    Route::get('/activities/export', [ActivityController::class, 'export'])->name('activities_export');

    Route::get('/agenda/index', [AgendaController::class, 'index'])->name('agenda_index');
    Route::get('/agenda/show/{id}', [AgendaController::class, 'show'])->name('agenda_show');
    Route::get('/agenda/edit/{id}', [AgendaController::class, 'edit'])->name('agenda_edit');
    Route::put('/agenda/{id}/agenda-update', [AgendaController::class, 'update'])->name('agenda_update');
    Route::post('/agenda/remove/{id}', [AgendaController::class, 'destroy'])->name('agenda_delete');
    Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda_create');
    Route::post('/agenda/store', [AgendaController::class, 'store'])->name('agenda_store');

});
