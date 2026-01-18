<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition(): array
    {
        $produtos = [
            // Eletrônicos
            'Smartphone Galaxy A54',
            'Notebook Samsung Book',
            'Smart TV 55 polegadas',
            
            // Roupas
            'Tênis Nike Air Max',
            'Camiseta Nike Dri-FIT',
            'Shorts Adidas Training',
            
            // Casa
            'Jogo de Panelas Tramontina',
            'Conjunto de Talheres Inox',
            'Faqueiro Tramontina 24 peças',
            
            // Esportes
            'Bola de Futebol Adidas',
            'Kit de Pesos Adidas',
            'Corda para Pular Fitness',
            
            // Beleza
            'Perfume Natura Essencial',
            'Kit de Maquiagem Natura',
            'Creme Hidratante Natura',
        ];

        return [
            'nome' => $this->faker->unique()->randomElement($produtos),
            'descricao' => $this->faker->sentence(8),
        ];
    }
}
