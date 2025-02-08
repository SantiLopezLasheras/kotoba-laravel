<?php

namespace Database\Seeders;

use App\Models\Lista;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lista::factory()->create([
            'nombre' => 'Vocabulario básico',
            'idioma' => 'inglés',
            'nivel' => 'principiante',
            'is_public' => true,
            'user_id' => 1,
        ]);

        Lista::factory()->create([
            'nombre' => 'Frases hechas',
            'idioma' => 'inglés',
            'nivel' => 'avanzado',
            'is_public' => true,
            'user_id' => 1,
        ]);

        Lista::factory()->create([
            'nombre' => 'HSK 1',
            'idioma' => 'chino',
            'nivel' => 'principiante',
            'is_public' => true,
            'user_id' => 1,
        ]);

        Lista::factory()->create([
            'nombre' => 'Animales',
            'idioma' => 'francés',
            'nivel' => 'principiante',
            'is_public' => true,
            'user_id' => 1,
        ]);
    }
}
