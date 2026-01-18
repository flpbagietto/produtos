<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition(): array
    {
        $categorias = [
            'Eletrônicos',
            'Roupas e Acessórios',
            'Casa e Decoração',
            'Esportes e Fitness',
            'Beleza e Perfumaria',
        ];

        return [
            'nome' => $this->faker->unique()->randomElement($categorias),
        ];
    }
}
