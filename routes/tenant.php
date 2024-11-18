<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Models\User;
use Inertia\Inertia;
use App\Http\Controllers\tenants\ProjectController;
use App\Http\Controllers\tenants\GetUsersController;
use App\Http\Controllers\tenants\GetProjectUsersController;
use App\Http\Controllers\tenants\TaskController;
use App\Http\Controllers\tenants\GroupTasksController;
use App\Http\Controllers\tenants\GetTaskUsersController;
use App\Http\Controllers\tenants\TaskChecklistController;
use App\Http\Controllers\tenants\ChecklistItemsController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        // Projects
        Route::resource('/projects', ProjectController::class)
            ->names('projects');

        // Tasks
        Route::resource('/tasks', TaskController::class)->names('tasks');
        // GroupTask
        Route::resource('/task/group', GroupTasksController::class)->names('groupTask');
        Route::resource('/task/checklist', GroupTasksController::class)->names('groupTask');


        Route::post('message/send', [TaskController::class, 'sendMessage'])->name('send-message');
        // End points routes (no related to a specfic component or controller "only invokable")

        // getting all users inside the tenant
        Route::get('get/users', GetUsersController::class)->name('getUsers');
        // getting all users for specific project
        Route::post('project/users', GetProjectUsersController::class)->name('getProjectUsers');
        // getting all users for specific task
        Route::resource('task/checklist', TaskChecklistController::class)->names('task-checklist'); // naming should be consistent 'this is a note to change them later'
        Route::resource('checklist/item', ChecklistItemsController::class)->names('checklist-item'); // naming should be consistent 'this is a note to change them later'


        Route::get('/test', function () {
            return Inertia::render('test');
        });
    });

    require __DIR__ . '/auth.php';
});