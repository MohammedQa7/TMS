<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->routeIs('getUsers') || $request->routeIs('getProjectUsers')) {
            // Return only 'id' and 'name' for the home page
            return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'profilePhoto' => $this->profile_photo_url,
            ];
        } else {
            // Return only 'name' for the edit page
            return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'profilePhoto' => $this->profile_photo_url,
                'joinedAt' => $this->created_at,
            ];
        }

    }
}