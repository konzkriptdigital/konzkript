<?php

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/* Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
}); */

Broadcast::channel('accounts.{id}', function (User $user, $companyId) {
    // logger($user->company->id);
    if($user->company) {
        return (int) $user->company->id === (int) $companyId;
    }
});

Broadcast::channel('company.{id}', function (User $user, $id) {
    // logger($user->company);
    return (int) $user->company->id === (int) $id;
});
/* Broadcast::channel('user.{id}', function (User $user, $id) {
    return (int) $user->id === (int) $id;
}); */
