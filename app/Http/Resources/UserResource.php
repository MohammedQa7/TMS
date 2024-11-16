<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

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
                'value' => $this->name,
                // this is the same as name but for vue-mention library (in order to let vue-mention get the username data)
                'email' => $this->email,
                'description' => Str::limit($this->description , 100),
                'profilePhoto' => $this->profile_photo_url,
                'joinedAt' => $this->created_at->format('m Y'),
            ];
        }

    }
}