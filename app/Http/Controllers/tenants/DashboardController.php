<?php

namespace App\Http\Controllers\tenants;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $start_date = Carbon::now()->startOfWeek()->subWeek();
        $end_date = Carbon::now()->endOfWeek()->subWeek();
        $days_until = $start_date->daysUntil($end_date);
        // dd($days_until->toArray());

        $task = Task::where('is_completed', true)->get()->groupBy(function ($task) {
            return $task->created_at->format('Y-m-d');
        });

        $data = [
            [
                'day' => Carbon::parse('2024-11-04')->format('l'),
                'Completed Tasks' => $task['2024-11-04']->count(),
            ],

            [
                'day' => Carbon::parse('2024-11-05')->format('l'),
                'Completed Tasks' => $task['2024-11-05']->count(),
            ],
            [
                'day' => Carbon::parse('2024-11-06')->format('l'),
                'Completed Tasks' => isset($task['2024-11-06']) ? $task['2024-11-06']->count() : 0,
            ],

            [
                'day' => Carbon::parse('2024-11-07')->format('l'),
                'Completed Tasks' => isset($task['2024-11-07']) ? $task['2024-11-07']->count() : 0,
            ],
            [
                'day' => Carbon::parse('2024-11-08')->format('l'),
                'Completed Tasks' => $task['2024-11-08']->count(),
            ],

            [
                'day' => Carbon::parse('2024-11-09')->format('l'),
                'Completed Tasks' => isset($task['2024-11-09']) ? $task['2024-11-09']->count() : 0,
            ],
        ];


        $users_productivity = User::withCount([
            'tasks' =>
            function ($query) {
                $query->where('is_completed', true)
                    ->where('completed_at', '>=', Carbon::now()->subMonth());
            }
        ])->get()->map(function ($user) {
            return [
                'username' => $user->name,
                'Completed Tasks' => $user->tasks_count,
            ];
        });


        return Inertia::render('Dashboard', [
            'statics' => $data,
            'userProductivity' => $users_productivity,
        ]);
    }
}