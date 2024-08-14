<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('accounts.{id}', function (User $user, $companyId) {
    return (int) $user->company->id === (int) $companyId;
});
