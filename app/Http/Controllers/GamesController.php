<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    // Mostrar juegos disponibles
    public function index()
    {
        return inertia('Games/Index');
    }


    public function repasar(Request $request)
{
        $listId = $request->query('listId'); // Getting listId from query parameter

        // Find the list by ID
        $lista = Lista::findOrFail($listId);

        // Get the flashcards associated with that list
        $flashcards = $lista->flashcards;

        // Return the data to the view via Inertia
        return inertia('Games/Repasar', [
            'lista' => $lista,
            'flashcards' => $flashcards,  // Pass flashcards along with the list
        ]);
}


}
