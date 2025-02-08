<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lista;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Lista $lista) {
        return $user->id == $lista->user_id || $lista->is_public;
    }

    public function update(User $user, Lista $lista)
    {
        return $user->id == $lista->user_id;
    }


    public function delete(User $user, Lista $lista): bool
    {
        return $user->id == $lista->user_id;
    }
}
