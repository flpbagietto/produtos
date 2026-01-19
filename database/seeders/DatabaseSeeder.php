<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categorias = [
            Categoria::firstOrCreate(['nome' => 'Eletrônicos']),
            Categoria::firstOrCreate(['nome' => 'Roupas e Acessórios']),
            Categoria::firstOrCreate(['nome' => 'Casa e Decoração']),
            Categoria::firstOrCreate(['nome' => 'Esportes e Fitness']),
            Categoria::firstOrCreate(['nome' => 'Beleza e Perfumaria']),
        ];

        $marcas = [
            Marca::firstOrCreate(['nome' => 'Samsung']),
            Marca::firstOrCreate(['nome' => 'Nike']),
            Marca::firstOrCreate(['nome' => 'Tramontina']),
            Marca::firstOrCreate(['nome' => 'Adidas']),
            Marca::firstOrCreate(['nome' => 'Natura']),
        ];

        $produtos = [
            ['nome' => 'Smartphone Galaxy A54', 'descricao' => 'Smartphone Android com tela de 6.4 polegadas, 128GB de armazenamento e câmera tripla de 50MP.', 'categoria' => 0, 'marca' => 0],
            ['nome' => 'Notebook Samsung Book', 'descricao' => 'Notebook com processador Intel Core i5, 8GB RAM, SSD 256GB e tela Full HD de 15.6 polegadas.', 'categoria' => 0, 'marca' => 0],
            ['nome' => 'Smart TV 55 polegadas', 'descricao' => 'Smart TV Samsung 55 polegadas 4K UHD com HDR e sistema Tizen integrado.', 'categoria' => 0, 'marca' => 0],
            ['nome' => 'Tênis Nike Air Max', 'descricao' => 'Tênis esportivo Nike Air Max com tecnologia de amortecimento e design moderno.', 'categoria' => 1, 'marca' => 1],
            ['nome' => 'Camiseta Nike Dri-FIT', 'descricao' => 'Camiseta esportiva Nike com tecnologia Dri-FIT que absorve o suor e mantém o conforto.', 'categoria' => 1, 'marca' => 1],
            ['nome' => 'Shorts Nike Training', 'descricao' => 'Shorts esportivo Nike para treinos com tecido respirável e elástico.', 'categoria' => 1, 'marca' => 1],
            ['nome' => 'Jogo de Panelas Tramontina', 'descricao' => 'Jogo completo de panelas Tramontina em alumínio com 5 peças e cabo ergonômico.', 'categoria' => 2, 'marca' => 2],
            ['nome' => 'Conjunto de Talheres Inox', 'descricao' => 'Conjunto de talheres Tramontina em aço inox com 24 peças e acabamento brilhante.', 'categoria' => 2, 'marca' => 2],
            ['nome' => 'Faqueiro Tramontina 24 peças', 'descricao' => 'Faqueiro completo Tramontina com 24 peças em aço inox e acabamento premium.', 'categoria' => 2, 'marca' => 2],
            ['nome' => 'Bola de Futebol Adidas', 'descricao' => 'Bola de futebol oficial Adidas com tecnologia de costura térmica e design clássico.', 'categoria' => 3, 'marca' => 3],
            ['nome' => 'Kit de Pesos Adidas', 'descricao' => 'Kit de pesos ajustáveis Adidas para treino em casa com barra e anilhas.', 'categoria' => 3, 'marca' => 3],
            ['nome' => 'Corda para Pular Fitness', 'descricao' => 'Corda para pular Adidas com cabo ajustável e contador de giros integrado.', 'categoria' => 3, 'marca' => 3],
            ['nome' => 'Perfume Natura Essencial', 'descricao' => 'Perfume Natura Essencial com fragrância floral e notas amadeiradas, 50ml.', 'categoria' => 4, 'marca' => 4],
            ['nome' => 'Kit de Maquiagem Natura', 'descricao' => 'Kit completo de maquiagem Natura com base, batom, máscara e pincéis.', 'categoria' => 4, 'marca' => 4],
            ['nome' => 'Creme Hidratante Natura', 'descricao' => 'Creme hidratante facial Natura com vitamina E e proteção solar FPS 30.', 'categoria' => 4, 'marca' => 4],
        ];

        foreach ($produtos as $dadosProduto) {
            Produto::firstOrCreate(
                ['nome' => $dadosProduto['nome']],
                [
                    'descricao' => $dadosProduto['descricao'],
                    'categoria_id' => $categorias[$dadosProduto['categoria']]->id,
                    'marca_id' => $marcas[$dadosProduto['marca']]->id,
                ]
            );
        }
    }
}
