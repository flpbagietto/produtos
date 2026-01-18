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
        // Criar 5 categorias brasileiras
        $categorias = [
            Categoria::create(['nome' => 'Eletrônicos']),
            Categoria::create(['nome' => 'Roupas e Acessórios']),
            Categoria::create(['nome' => 'Casa e Decoração']),
            Categoria::create(['nome' => 'Esportes e Fitness']),
            Categoria::create(['nome' => 'Beleza e Perfumaria']),
        ];

        // Criar 5 marcas brasileiras
        $marcas = [
            Marca::create(['nome' => 'Samsung']),
            Marca::create(['nome' => 'Nike']),
            Marca::create(['nome' => 'Tramontina']),
            Marca::create(['nome' => 'Adidas']),
            Marca::create(['nome' => 'Natura']),
        ];

        // Criar 3 produtos para cada categoria (total: 15 produtos)
        // Cada produto terá 1 marca associada
        
        // Eletrônicos - Samsung
        $produto1 = Produto::create(['nome' => 'Smartphone Galaxy A54', 'descricao' => 'Smartphone Android com tela de 6.4 polegadas, 128GB de armazenamento e câmera tripla de 50MP.']);
        $produto1->categorias()->attach($categorias[0]->id);
        $produto1->marcas()->attach($marcas[0]->id);

        $produto2 = Produto::create(['nome' => 'Notebook Samsung Book', 'descricao' => 'Notebook com processador Intel Core i5, 8GB RAM, SSD 256GB e tela Full HD de 15.6 polegadas.']);
        $produto2->categorias()->attach($categorias[0]->id);
        $produto2->marcas()->attach($marcas[0]->id);

        $produto3 = Produto::create(['nome' => 'Smart TV 55 polegadas', 'descricao' => 'Smart TV Samsung 55 polegadas 4K UHD com HDR e sistema Tizen integrado.']);
        $produto3->categorias()->attach($categorias[0]->id);
        $produto3->marcas()->attach($marcas[0]->id);

        // Roupas e Acessórios - Nike
        $produto4 = Produto::create(['nome' => 'Tênis Nike Air Max', 'descricao' => 'Tênis esportivo Nike Air Max com tecnologia de amortecimento e design moderno.']);
        $produto4->categorias()->attach($categorias[1]->id);
        $produto4->marcas()->attach($marcas[1]->id);

        $produto5 = Produto::create(['nome' => 'Camiseta Nike Dri-FIT', 'descricao' => 'Camiseta esportiva Nike com tecnologia Dri-FIT que absorve o suor e mantém o conforto.']);
        $produto5->categorias()->attach($categorias[1]->id);
        $produto5->marcas()->attach($marcas[1]->id);

        $produto6 = Produto::create(['nome' => 'Shorts Nike Training', 'descricao' => 'Shorts esportivo Nike para treinos com tecido respirável e elástico.']);
        $produto6->categorias()->attach($categorias[1]->id);
        $produto6->marcas()->attach($marcas[1]->id);

        // Casa e Decoração - Tramontina
        $produto7 = Produto::create(['nome' => 'Jogo de Panelas Tramontina', 'descricao' => 'Jogo completo de panelas Tramontina em alumínio com 5 peças e cabo ergonômico.']);
        $produto7->categorias()->attach($categorias[2]->id);
        $produto7->marcas()->attach($marcas[2]->id);

        $produto8 = Produto::create(['nome' => 'Conjunto de Talheres Inox', 'descricao' => 'Conjunto de talheres Tramontina em aço inox com 24 peças e acabamento brilhante.']);
        $produto8->categorias()->attach($categorias[2]->id);
        $produto8->marcas()->attach($marcas[2]->id);

        $produto9 = Produto::create(['nome' => 'Faqueiro Tramontina 24 peças', 'descricao' => 'Faqueiro completo Tramontina com 24 peças em aço inox e acabamento premium.']);
        $produto9->categorias()->attach($categorias[2]->id);
        $produto9->marcas()->attach($marcas[2]->id);

        // Esportes e Fitness - Adidas
        $produto10 = Produto::create(['nome' => 'Bola de Futebol Adidas', 'descricao' => 'Bola de futebol oficial Adidas com tecnologia de costura térmica e design clássico.']);
        $produto10->categorias()->attach($categorias[3]->id);
        $produto10->marcas()->attach($marcas[3]->id);

        $produto11 = Produto::create(['nome' => 'Kit de Pesos Adidas', 'descricao' => 'Kit de pesos ajustáveis Adidas para treino em casa com barra e anilhas.']);
        $produto11->categorias()->attach($categorias[3]->id);
        $produto11->marcas()->attach($marcas[3]->id);

        $produto12 = Produto::create(['nome' => 'Corda para Pular Fitness', 'descricao' => 'Corda para pular Adidas com cabo ajustável e contador de giros integrado.']);
        $produto12->categorias()->attach($categorias[3]->id);
        $produto12->marcas()->attach($marcas[3]->id);

        // Beleza e Perfumaria - Natura
        $produto13 = Produto::create(['nome' => 'Perfume Natura Essencial', 'descricao' => 'Perfume Natura Essencial com fragrância floral e notas amadeiradas, 50ml.']);
        $produto13->categorias()->attach($categorias[4]->id);
        $produto13->marcas()->attach($marcas[4]->id);

        $produto14 = Produto::create(['nome' => 'Kit de Maquiagem Natura', 'descricao' => 'Kit completo de maquiagem Natura com base, batom, máscara e pincéis.']);
        $produto14->categorias()->attach($categorias[4]->id);
        $produto14->marcas()->attach($marcas[4]->id);

        $produto15 = Produto::create(['nome' => 'Creme Hidratante Natura', 'descricao' => 'Creme hidratante facial Natura com vitamina E e proteção solar FPS 30.']);
        $produto15->categorias()->attach($categorias[4]->id);
        $produto15->marcas()->attach($marcas[4]->id);
    }
}
