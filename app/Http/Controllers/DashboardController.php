<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Lista;
use App\Models\User;
use App\Models\Flashcard;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Access denied');
        }

        $numberLists = Lista::count();
        $numberFlashcards = Flashcard::count();
        $numberUsers = User::count();
        $numberLanguages =Lista::distinct('idioma')->count('idioma');
        $numberAdmins = User::where('role', 'admin')->count();
        $users = User::where('role', 'user')->withCount(['lists', 'loginHistories'])->get() ->map(function ($user) {
            $user->formatted_created_at = Carbon::parse($user->created_at)->format('d M Y H:i');
            $user->last_login_date = $user->loginHistories()->latest()->first()?->login_date;
            return $user;
    });

        return Inertia::render('Dashboard', [
            'numberLists' => $numberLists,
            'numberFlashcards' => $numberFlashcards,
            'numberUsers' => $numberUsers,
            'numberLanguages' => $numberLanguages,
            'numberAdmins' => $numberAdmins,
            'users' => $users
        ]);
    }

    public function banear($id) {

        if (Auth::user()->role === 'admin') {
            // buscar al usuario
            $user = User::findOrFail($id);

            // cambiar el estado de la cuenta
            $user->is_active = !$user->is_active;
            $user->save();
        }
    }
}
