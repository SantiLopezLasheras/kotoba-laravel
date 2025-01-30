<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    // Mostrar todos los juegos
    public function index()
    {
        return inertia('Games');
    }
}
