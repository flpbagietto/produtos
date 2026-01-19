<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;
use Livewire\Component;

class BuscaProdutos extends Component
{
    public string $nome = '';
    public array $categoriasSelecionadas = [];
    public array $marcasSelecionadas = [];
    public string $buscaCategoria = '';
    public string $buscaMarca = '';

    protected $layout = 'layouts.app';

    protected $queryString = [
        'nome' => ['except' => ''],
        'categoriasSelecionadas' => ['except' => []],
        'marcasSelecionadas' => ['except' => []],
    ];

    public function mount(): void
    {
    }

    public function atualizarFiltros(): void
    {
    }
    
    public function updatedCategoriasSelecionadas($value): void
    {
        if (is_array($this->categoriasSelecionadas)) {
            $this->categoriasSelecionadas = array_values(array_filter(array_map('intval', $this->categoriasSelecionadas)));
        } else {
            $this->categoriasSelecionadas = [];
        }
    }
    
    public function updatedMarcasSelecionadas($value): void
    {
        if (is_array($this->marcasSelecionadas)) {
            $this->marcasSelecionadas = array_values(array_filter(array_map('intval', $this->marcasSelecionadas)));
        } else {
            $this->marcasSelecionadas = [];
        }
    }
    
    public function updatedNome(): void
    {
    }

    public function limparFiltros(): void
    {
        $this->nome = '';
        $this->categoriasSelecionadas = [];
        $this->marcasSelecionadas = [];
        $this->buscaCategoria = '';
        $this->buscaMarca = '';
    }
    
    private function filtrarCategorias($categorias)
    {
        if (empty($this->buscaCategoria)) {
            return $categorias;
        }
        
        return $categorias->filter(function ($categoria) {
            return stripos($categoria->nome, $this->buscaCategoria) !== false;
        });
    }
    
    private function filtrarMarcas($marcas)
    {
        if (empty($this->buscaMarca)) {
            return $marcas;
        }
        
        return $marcas->filter(function ($marca) {
            return stripos($marca->nome, $this->buscaMarca) !== false;
        });
    }

    private function buscarProdutos()
    {
        $query = Produto::query()
            ->with(['categoria', 'marca']);

        $query = $this->aplicarFiltros($query);

        return $query->get();
    }

    private function aplicarFiltros($query)
    {
        if (!empty($this->nome)) {
            $query->where('nome', 'like', '%' . $this->nome . '%');
        }

        if (!empty($this->categoriasSelecionadas) && is_array($this->categoriasSelecionadas) && count($this->categoriasSelecionadas) > 0) {
            $categoriasIds = array_values(array_filter(array_map('intval', $this->categoriasSelecionadas)));
            if (count($categoriasIds) > 0) {
                $query->whereIn('categoria_id', $categoriasIds);
            }
        }

        if (!empty($this->marcasSelecionadas) && is_array($this->marcasSelecionadas) && count($this->marcasSelecionadas) > 0) {
            $marcasIds = array_values(array_filter(array_map('intval', $this->marcasSelecionadas)));
            if (count($marcasIds) > 0) {
                $query->whereIn('marca_id', $marcasIds);
            }
        }

        return $query;
    }

    public function render()
    {
        $produtos = $this->buscarProdutos();
        $todasCategorias = Categoria::orderBy('nome')->get();
        $todasMarcas = Marca::orderBy('nome')->get();
        
        $categorias = $this->filtrarCategorias($todasCategorias);
        $marcas = $this->filtrarMarcas($todasMarcas);

        return view('livewire.busca-produtos', [
            'produtos' => $produtos,
            'categorias' => $categorias,
            'marcas' => $marcas,
        ]);
    }
}
