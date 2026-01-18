<?php

namespace Database\Factories;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarcaFactory extends Factory
{
    protected $model = Marca::class;

    public function definition(): array
    {
        $marcas = [
            'Samsung',
            'Nike',
            'Tramontina',
            'Adidas',
            'Natura',
        ];

        return [
            'nome' => $this->faker->unique()->randomElement($marcas),
        ];
    }
}
