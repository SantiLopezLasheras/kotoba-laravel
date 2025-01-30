<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\Lista;
use Illuminate\Http\Request;

class FlashcardController extends Controller
{
    // Mostrar todas las tarjetas
    public function index($listId)
    {
        $list = Lista::findOrFail($listId);
        $flashcards = $list->flashcards;

        return inertia('Flashcards/Index', ['list' => $list, 'flashcards' => $flashcards]);
    }

    // Mostrar formulario para crear una tarjeta
    public function create($listId)
    {
        return inertia('Flashcards/Create', ['listId' => $listId]);
    }

    // Guardar una tarjeta
    public function store(Request $request, $listId)
    {
        // buscar lista 
        $list = Lista::findOrFail($listId);

        $validated = $request->validate([
            'palabra' => 'required|string|max:255',
            'traduccion' => 'required|string|max:255',
            'cat_gramatical' => 'nullable|string|max:100',
            'pronunciacion' => 'nullable|string|max:255',
            'frase_ejemplo' => 'nullable|string',
            'notas' => 'nullable|string',
        ]);

        $flashcard = new Flashcard($validated);
        $flashcard->list_id = $list->id;
        $flashcard->save();

        return redirect()->route('flashcards.index', ['listId' => $list->id]);
    }

    // Mostrar una tarjeta
    public function edit($listId, $flashcardId)
    {
        $flashcard = Flashcard::findOrFail($flashcardId);

        return inertia('Flashcards/Edit', ['flashcard' => $flashcard, 'listId' => $listId]);
    }

    // Actualizar tarjeta
    public function update(Request $request, $listId, $flashcardId)
    {
        $validated = $request->validate([
            'palabra' => 'required|string|max:255',
            'traduccion' => 'required|string|max:255',
            'cat_gramatical' => 'nullable|string|max:100',
            'pronunciacion' => 'nullable|string|max:255',
            'frase_ejemplo' => 'nullable|string',
            'notas' => 'nullable|string',
        ]);

        $flashcard = Flashcard::findOrFail($flashcardId);
        $flashcard->update($validated);

        return redirect()->route('flashcards.index', ['listId' => $listId]);
    }

    // Eliminar una tarjeta
    public function destroy($listId, $flashcardId)
    {
        $flashcard = Flashcard::findOrFail($flashcardId);
        $flashcard->delete();

        return redirect()->route('flashcards.index', ['listId' => $listId]);
    }
}
