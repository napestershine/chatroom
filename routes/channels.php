<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chatroom', function ($user) {
    return $user;
});
