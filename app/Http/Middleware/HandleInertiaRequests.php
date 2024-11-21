<?php

namespace App\Http\Middleware;

use App\Http\Resources\ProjectResource;
use App\Http\Resources\UserResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'projectsNavItems' => Project::select('name', 'slug')->get()->map(function ($project) {
                return [
                    'title' => $project->name,
                    'url' => route('projects.show', $project->slug),
                ];
            }),

            // Filepond csrf token
            'csrf' => csrf_token(),
        ];
    }
}