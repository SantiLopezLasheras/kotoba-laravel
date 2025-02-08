<?php

namespace App\Listeners;


use App\Models\LoginHistory;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LogUserLogin
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
    public function handle(Login $event): void
    {
        $user = User::find($event->user->id);

        // Crear un nuevo registro de login del usuario
        LoginHistory::create([
            'user_id' => $user->id,
            'login_date' => now()
        ]);

        // actualizar número de inicio de sesiones del usuario
        $user->login_count = $user->login_count + 1;
        $user->save();
    }
}
