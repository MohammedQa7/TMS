<?php

namespace App\Http\Controllers\tenants;

use App\Enums\TaskPriorites;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GetUsersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        sleep(1);
        return response()->json([
            'members' => UserResource::collection(User::get())
        ]);
    }
}