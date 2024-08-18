<?php

namespace App\Listeners;

use App\Events\LoginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\UserLoginHistory;

class StoreUserLoginHistory
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LoginHistory $event): void
    {

        $userinfo = $event->user;

        UserLoginHistory::create([
            'user_id' => $userinfo->id,
            'name' => $userinfo->name,
            'email' => $userinfo->email,
        ]);
    }
}
