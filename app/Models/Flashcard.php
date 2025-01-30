<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    use HasFactory;

    protected $table = 'flashcards';

    protected $fillable = [
        'list_id',
        'palabra',
        'traduccion',
        'cat_gramatical',
        'pronunciacion',
        'frase_ejemplo',
        'notas',
    ];

    // public function list()
    // {
    //     return $this->belongsTo(ListModel::class);
    // }
}
