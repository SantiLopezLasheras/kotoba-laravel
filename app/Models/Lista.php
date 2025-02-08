<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;

    protected $table = 'lists';

    protected $fillable = [
        'nombre',
        'idioma',
        'nivel',
        'user_id',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function flashcards()
    {
        return $this->hasMany(Flashcard::class, 'list_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
