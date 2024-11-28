<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Inertia\Inertia;
use App\Http\Controllers\tenants\ProjectController;
use App\Http\Controllers\tenants\GetUsersController;
use App\Http\Controllers\tenants\GetProjectUsersController;
use App\Http\Controllers\tenants\TaskController;
use App\Http\Controllers\tenants\GroupTasksController;
use App\Http\Controllers\tenants\GetTaskUsersController;
use App\Http\Controllers\tenants\TaskChecklistController;
use App\Http\Controllers\tenants\ChecklistItemsController;
use App\Http\Controllers\tenants\UploadTemporatyAttachmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


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
    // Route::get('/', function () {
    //     return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    // });

    Route::post('/custom/auth', function (Request $request) {
        return Broadcast::auth($request);
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        // Projects
        Route::resource('/projects', ProjectController::class)
            ->names('projects');

        // Tasks
        Route::resource('/tasks', TaskController::class)->names('tasks');

        // Task external props
        Route::resource('task/checklist', TaskChecklistController::class)->names('task-checklist'); // Task Checklists
        Route::resource('checklist/item', ChecklistItemsController::class)->names('checklist-item');
        Route::post('message/send', [TaskController::class, 'sendMessage'])->name('send-message'); // Task Messages (Chat)
        Route::delete('task/remove/member/{task}', [TaskController::class, 'removeMember'])->name('remove-member-from-task'); // Rmoving a member from a teask


        // GroupTask
        Route::resource('/task/group', GroupTasksController::class)->names('groupTask');
        Route::resource('/task/checklist', GroupTasksController::class)->names('groupTask');



        // End points routes (no related to a specfic component or controller "only invokable")
        // getting all users inside the tenant
        Route::get('get/users', GetUsersController::class)->name('getUsers');
        // getting all users for specific task
        Route::get('get/users/{task}', GetTaskUsersController::class)->name('getTaskUsers');
        // getting all users for specific project
        Route::post('project/users', GetProjectUsersController::class)->name('getProjectUsers');





        // File Uploads for Filpond
        Route::post('/attachment/upload', [UploadTemporatyAttachmentController::class, 'upload'])->name('attachment-upload');
        Route::post('/attachment/revert', [UploadTemporatyAttachmentController::class, 'revert'])->name('attachment-revert');
        Route::get('/attachment/download', function (Request $request) {
            if ($request->attachmentPath) {
                $tenant_id = tenant('id');
                $attachments_path = public_path("storage/tenant{$tenant_id}") . '/' . $request->attachmentPath;
                return Response::download($attachments_path);
            } else {
                abort(404, 'No file were found');
            }
        })->name('download');



        Route::get('/roles', function () {
            // $user = auth()->user();
            // $role = Role::create(['name' => 'Can View Chat']);
            // $permission = Permission::create(['name' => PermissionsEnum::VIEW_CHAT]);
            // $permission->assignRole($role);
            // $user->assignRoleWithProject($role->name, 13);
        });
        Route::get('/test', function () {
            return Inertia::render('test');
        });
    });

    require __DIR__ . '/auth.php';
});