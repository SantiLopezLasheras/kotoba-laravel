<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    // Mostrar todas las listas
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $lists = Lista::orderByDesc('created_at')->get();
            return inertia('Lists/Index', ['lists' => $lists]);
        }

        $lists = Lista::where('user_id', Auth::id())->orWhere('is_public', true)->orderByDesc('created_at')->get();
        return inertia('Lists/Index', ['lists' => $lists, 'user' => $user]);
    }


    // public function index(Request $request)
    // {
    //     $filter = $request->input('filter', 'all');

    //     $query = Lista::query();

    //     if ($filter === 'mine') {
    //         $query->where('user_id', Auth::id());
    //     } elseif ($filter === 'public') {
    //         $query->where('is_public', true);
    //     } else {
    //         $query->where(function ($query) {
    //             $query->where('user_id', Auth::id())
    //                   ->orWhere('is_public', true);
    //         });
    //     }

    //     $lists = $query->get();

    //     return inertia('Lists/Index', ['lists' => $lists]);
    // }

    // Mostrar formulario para crear una lista
    public function create()
    {
        return inertia('Lists/Create');
    }

    // Guardar lista nueva
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|min:2|max:255',
            'idioma' => 'required|string|min:2|max:50',
            'nivel' => 'required|in:principiante,intermedio,avanzado',
        ]);

        $validated['user_id'] = Auth::id();

        Lista::create($validated);

        return redirect()->route('lists.index');
    }

    // Actualizar lista
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'idioma' => 'required|string|max:50',
            'nivel' => 'required|in:principiante,intermedio,avanzado',
        ]);

        $list = Lista::findOrFail($id);
        Gate::authorize('delete', $list);
        $list->update($validated);

        return redirect()->route('lists.index');
    }

    // Eliminar lista
    public function destroy($id)
    {
        $list = Lista::findOrFail($id);
        Gate::authorize('delete', $list);
        $list->delete();

        return redirect()->route('lists.index');
    }
}
