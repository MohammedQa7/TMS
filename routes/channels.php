<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Stancl\Tenancy\Tenancy;

Broadcast::channel('users.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('liveChat.{chat_id}', function ($user, $chat_id) {
    $chat = Chat::find($chat_id);
    return $user->tasks()->where('task_id', $chat->task_id)->exists();
});