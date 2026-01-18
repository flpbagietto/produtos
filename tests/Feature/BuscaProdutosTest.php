<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use App\Livewire\BuscaProdutos;

class BuscaProdutosTest extends TestCase
{
    use RefreshDatabase;

    private Categoria $categoriaEletronicos;
    private Categoria $categoriaRoupas;
    private Marca $marcaSamsung;
    private Marca $marcaNike;
    private Produto $produto1;
    private Produto $produto2;
    private Produto $produto3;

    protected function setUp(): void
    {
        parent::setUp();

        $this->categoriaEletronicos = Categoria::factory()->create(['nome' => 'Eletrônicos']);
        $this->categoriaRoupas = Categoria::factory()->create(['nome' => 'Roupas']);
        
        $this->marcaSamsung = Marca::factory()->create(['nome' => 'Samsung']);
        $this->marcaNike = Marca::factory()->create(['nome' => 'Nike']);

        $this->produto1 = Produto::factory()->create(['nome' => 'Smartphone Galaxy']);
        $this->produto1->categorias()->sync([$this->categoriaEletronicos->id]);
        $this->produto1->marcas()->sync([$this->marcaSamsung->id]);

        $this->produto2 = Produto::factory()->create(['nome' => 'Tênis Esportivo']);
        $this->produto2->categorias()->sync([$this->categoriaRoupas->id]);
        $this->produto2->marcas()->sync([$this->marcaNike->id]);

        $this->produto3 = Produto::factory()->create(['nome' => 'Notebook Dell']);
        $this->produto3->categorias()->sync([$this->categoriaEletronicos->id]);
    }

    public function test_busca_por_nome_do_produto(): void
    {
        Livewire::test(BuscaProdutos::class)
            ->set('nome', 'Smartphone')
            ->assertSee('Smartphone Galaxy')
            ->assertDontSee('Tênis Esportivo')
            ->assertDontSee('Notebook Dell');
    }

    public function test_busca_por_categoria(): void
    {
        Livewire::test(BuscaProdutos::class)
            ->set('categoriasSelecionadas', [$this->categoriaEletronicos->id])
            ->assertSee('Smartphone Galaxy')
            ->assertSee('Notebook Dell')
            ->assertDontSee('Tênis Esportivo');
    }

    public function test_busca_por_marca(): void
    {
        $this->produto3->marcas()->sync([]);
        
        Livewire::test(BuscaProdutos::class)
            ->set('marcasSelecionadas', [$this->marcaSamsung->id])
            ->assertSee('Smartphone Galaxy')
            ->assertDontSee('Tênis Esportivo')
            ->assertDontSee('Notebook Dell');
    }

    public function test_busca_combinada_nome_e_categoria(): void
    {
        Livewire::test(BuscaProdutos::class)
            ->set('nome', 'Smartphone')
            ->set('categoriasSelecionadas', [$this->categoriaEletronicos->id])
            ->assertSee('Smartphone Galaxy')
            ->assertDontSee('Tênis Esportivo')
            ->assertDontSee('Notebook Dell');
    }

    public function test_busca_combinada_nome_categoria_e_marca(): void
    {
        Livewire::test(BuscaProdutos::class)
            ->set('nome', 'Smartphone')
            ->set('categoriasSelecionadas', [$this->categoriaEletronicos->id])
            ->set('marcasSelecionadas', [$this->marcaSamsung->id])
            ->assertSee('Smartphone Galaxy')
            ->assertDontSee('Tênis Esportivo')
            ->assertDontSee('Notebook Dell');
    }

    public function test_busca_por_multiplas_categorias(): void
    {
        $produtoMultiCategoria = Produto::factory()->create(['nome' => 'Produto Multi']);
        $produtoMultiCategoria->categorias()->sync([
            $this->categoriaEletronicos->id,
            $this->categoriaRoupas->id
        ]);

        Livewire::test(BuscaProdutos::class)
            ->set('categoriasSelecionadas', [
                $this->categoriaEletronicos->id,
                $this->categoriaRoupas->id
            ])
            ->assertSee('Produto Multi')
            ->assertSee('Smartphone Galaxy')
            ->assertSee('Tênis Esportivo');
    }

    public function test_busca_por_multiplas_marcas(): void
    {
        $produtoMultiMarca = Produto::factory()->create(['nome' => 'Produto Multi Marca']);
        $produtoMultiMarca->marcas()->sync([
            $this->marcaSamsung->id,
            $this->marcaNike->id
        ]);

        Livewire::test(BuscaProdutos::class)
            ->set('marcasSelecionadas', [
                $this->marcaSamsung->id,
                $this->marcaNike->id
            ])
            ->assertSee('Produto Multi Marca')
            ->assertSee('Smartphone Galaxy')
            ->assertSee('Tênis Esportivo');
    }

    public function test_limpeza_dos_filtros(): void
    {
        $component = Livewire::test(BuscaProdutos::class)
            ->set('nome', 'Smartphone')
            ->set('categoriasSelecionadas', [$this->categoriaEletronicos->id])
            ->set('marcasSelecionadas', [$this->marcaSamsung->id]);

        $component->call('limparFiltros');

        $component->assertSet('nome', '')
            ->assertSet('categoriasSelecionadas', [])
            ->assertSet('marcasSelecionadas', []);
    }

    public function test_persistencia_dos_filtros_apos_refresh(): void
    {
        $component = Livewire::test(BuscaProdutos::class)
            ->set('nome', 'Smartphone')
            ->set('categoriasSelecionadas', [$this->categoriaEletronicos->id])
            ->set('marcasSelecionadas', [$this->marcaSamsung->id]);

        $component = Livewire::test(BuscaProdutos::class, [
            'nome' => 'Smartphone',
            'categoriasSelecionadas' => [$this->categoriaEletronicos->id],
            'marcasSelecionadas' => [$this->marcaSamsung->id],
        ]);

        $component->assertSet('nome', 'Smartphone')
            ->assertSet('categoriasSelecionadas', [$this->categoriaEletronicos->id])
            ->assertSet('marcasSelecionadas', [$this->marcaSamsung->id])
            ->assertSee('Smartphone Galaxy');
    }

    public function test_busca_case_insensitive_por_nome(): void
    {
        Livewire::test(BuscaProdutos::class)
            ->set('nome', 'SMARTPHONE')
            ->assertSee('Smartphone Galaxy');

        Livewire::test(BuscaProdutos::class)
            ->set('nome', 'smartphone')
            ->assertSee('Smartphone Galaxy');
    }

    public function test_busca_parcial_por_nome(): void
    {
        Livewire::test(BuscaProdutos::class)
            ->set('nome', 'Galaxy')
            ->assertSee('Smartphone Galaxy');

        Livewire::test(BuscaProdutos::class)
            ->set('nome', 'Tênis')
            ->assertSee('Tênis Esportivo');
    }

    public function test_sem_resultados_com_filtros_inexistentes(): void
    {
        Livewire::test(BuscaProdutos::class)
            ->set('nome', 'ProdutoInexistente')
            ->assertSee('Nenhum produto encontrado');
    }

    public function test_exibe_todos_os_produtos_sem_filtros(): void
    {
        $component = Livewire::test(BuscaProdutos::class);

        $component->assertSee('Smartphone Galaxy')
            ->assertSee('Tênis Esportivo')
            ->assertSee('Notebook Dell');
    }

    public function test_contagem_correta_de_produtos(): void
    {
        Livewire::test(BuscaProdutos::class)
            ->set('nome', 'Smartphone')
            ->assertSee('produto encontrado');

        Livewire::test(BuscaProdutos::class)
            ->set('categoriasSelecionadas', [$this->categoriaEletronicos->id])
            ->assertSee('produtos encontrados');
    }

    public function test_filtro_de_busca_por_categoria_na_lista(): void
    {
        $component = Livewire::test(BuscaProdutos::class)
            ->set('buscaCategoria', 'Eletrônicos');

        $component->assertSee('Eletrônicos');
        
        $component->set('buscaCategoria', 'Eletr')
            ->assertSee('Eletrônicos');
    }

    public function test_filtro_de_busca_por_marca_na_lista(): void
    {
        $component = Livewire::test(BuscaProdutos::class)
            ->set('buscaMarca', 'Samsung');

        $component->assertSee('Samsung');
        
        $component->set('buscaMarca', 'Sam')
            ->assertSee('Samsung');
    }

    public function test_limpar_filtros_exibe_todos_os_produtos(): void
    {
        $component = Livewire::test(BuscaProdutos::class)
            ->set('nome', 'Smartphone')
            ->set('categoriasSelecionadas', [$this->categoriaEletronicos->id]);

        $component->call('limparFiltros');

        $component->assertSee('Smartphone Galaxy')
            ->assertSee('Tênis Esportivo')
            ->assertSee('Notebook Dell');
    }
}

