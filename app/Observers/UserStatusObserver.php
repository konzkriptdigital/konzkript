<?php

namespace App\Observers;

use App\Events\UserStatusEvent;
use App\Models\UserStatus;

class UserStatusObserver
{
    /**
     * Handle the UserStatus "created" event.
     */
    public function created(UserStatus $userStatus): void
    {
        logger("user status observer =>> ".$userStatus->user);
        $company = $userStatus->user->company;
        UserStatusEvent::dispatch(
            $company,
            'create',
            $userStatus
        );
    }

    /**
     * Handle the UserStatus "updated" event.
     */
    public function updated(UserStatus $userStatus): void
    {
        $company = $userStatus->user->company;
        UserStatusEvent::dispatch(
            $company,
            'update',
            $userStatus
        );
    }

    /**
     * Handle the UserStatus "deleted" event.
     */
    public function deleted(UserStatus $userStatus): void
    {
        //
    }

    /**
     * Handle the UserStatus "restored" event.
     */
    public function restored(UserStatus $userStatus): void
    {
        //
    }

    /**
     * Handle the UserStatus "force deleted" event.
     */
    public function forceDeleted(UserStatus $userStatus): void
    {
        //
    }
}
