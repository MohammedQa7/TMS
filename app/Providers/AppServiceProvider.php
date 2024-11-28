<?php

namespace App\Providers;

use App\Http\Middleware\addTenantToBroadcasting;
use App\Models\Project;
use App\Models\Task;
use App\Observers\ProjectObserver;
use App\Observers\TaskObserver;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        Project::observe(ProjectObserver::class);
        Task::observe(TaskObserver::class);
        // Broadcast::routes([
        //     'middleware' => ['web', 'auth', InitializeTenancyByRequestData::class, addTenantToBroadcasting::class], // Add tenancy middleware here
        // ]);
        // require base_path('routes/channels.php');

    }
}