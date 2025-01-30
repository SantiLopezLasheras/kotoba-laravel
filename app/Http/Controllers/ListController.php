<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use Illuminate\Http\Request;

class ListController extends Controller
{
    // Mostrar todas las listas
    public function index()
    {
        $lists = Lista::all();
        return inertia('Lists/Index', ['lists' => $lists]);
    }

    // Mostrar una lista
    public function show($id)
{
    $list = Lista::findOrFail($id);
    return inertia('Lists/Show', ['list' => $list]);
}

    // Mostrar formulario para crear una lista
    public function create()
    {
        return inertia('Lists/Create');
    }

    // Guardar lista nueva
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'idioma' => 'required|string|max:50',
            'nivel' => 'required|in:principiante,intermedio,avanzado',
        ]);

        Lista::create($validated);

        return redirect()->route('lists.index');
    }

    // Mostrar formulario para editar lista
    public function edit($id)
    {
        $list = Lista::findOrFail($id);
        return inertia('Lists/Edit', ['list' => $list]);
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
        $list->update($validated);

        return redirect()->route('lists.index');
    }

    // Eliminar lista
    public function destroy($id)
    {
        $list = Lista::findOrFail($id);
        $list->delete();

        return redirect()->route('lists.index');
    }
}
