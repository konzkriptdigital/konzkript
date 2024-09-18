<?php

namespace App\Console\Commands;

use App\Models\UserStatus;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UserStatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update-user-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update User Status Command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fiveMinutesAgo = Carbon::now()->subMinutes(5);

        UserStatus::where('last_seen_at', '<', $fiveMinutesAgo)
            ->where('is_online', 1)
            ->update(['is_online' => 0]);
    }
}
