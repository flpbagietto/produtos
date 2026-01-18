<div>
    <div class="header">
        <div class="header-content">
            <div class="logo">Busca de Produtos</div>
        </div>
    </div>

    <div class="main-container">
    <aside class="sidebar">
        <h3>Filtros</h3>
        
        <div>
            <div class="filtro-section">
                <label for="nome">Buscar por nome</label>
                <input 
                    type="text" 
                    id="nome" 
                    class="search-input"
                    wire:model.live.debounce.300ms="nome"
                    placeholder="Digite o nome do produto..."
                >
            </div>

            <div class="filtro-section">
                <label for="categorias">Categorias</label>
                <input 
                    type="text" 
                    class="search-input"
                    wire:model.live.debounce.200ms="buscaCategoria"
                    placeholder="Buscar categoria..."
                    style="margin-bottom: 12px;"
                >
                <div class="checkbox-list">
                    @forelse($categorias as $categoria)
                        <div class="checkbox-item">
                            <input 
                                type="checkbox" 
                                id="categoria_{{ $categoria->id }}" 
                                wire:model.live="categoriasSelecionadas"
                                value="{{ (string)$categoria->id }}"
                            >
                            <label for="categoria_{{ $categoria->id }}">{{ $categoria->nome }}</label>
                        </div>
                    @empty
                        <div style="padding: 12px; color: #999; font-size: 13px;">
                            @if(!empty($buscaCategoria))
                                Nenhuma categoria encontrada para "{{ $buscaCategoria }}"
                            @else
                                Nenhuma categoria disponível
                            @endif
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="filtro-section">
                <label for="marcas">Marcas</label>
                <input 
                    type="text" 
                    class="search-input"
                    wire:model.live.debounce.200ms="buscaMarca"
                    placeholder="Buscar marca..."
                    style="margin-bottom: 12px;"
                >
                <div class="checkbox-list">
                    @forelse($marcas as $marca)
                        <div class="checkbox-item">
                            <input 
                                type="checkbox" 
                                id="marca_{{ $marca->id }}" 
                                wire:model.live="marcasSelecionadas"
                                value="{{ (string)$marca->id }}"
                            >
                            <label for="marca_{{ $marca->id }}">{{ $marca->nome }}</label>
                        </div>
                    @empty
                        <div style="padding: 12px; color: #999; font-size: 13px;">
                            @if(!empty($buscaMarca))
                                Nenhuma marca encontrada para "{{ $buscaMarca }}"
                            @else
                                Nenhuma marca disponível
                            @endif
                        </div>
                    @endforelse
                </div>
            </div>

            <button type="button" wire:click="limparFiltros" wire:loading.attr="disabled" class="btn-limpar">
                <span wire:loading.remove wire:target="limparFiltros">Limpar filtros</span>
                <span wire:loading wire:target="limparFiltros">Limpando...</span>
            </button>
        </div>
    </aside>

    <main class="content-area">
        @if($produtos->count() > 0)
            <div class="results-header">
                <div class="results-count">
                    <strong>{{ $produtos->count() }}</strong> produto{{ $produtos->count() > 1 ? 's' : '' }} encontrado{{ $produtos->count() > 1 ? 's' : '' }}
                </div>
            </div>

            <div class="produtos-grid">
                @foreach($produtos as $produto)
                    <div class="produto-card">
                        <div class="produto-nome">{{ $produto->nome }}</div>
                        @if($produto->descricao)
                            <div class="produto-descricao">{{ $produto->descricao }}</div>
                        @endif
                        <div class="produto-tags">
                            @foreach($produto->categorias as $categoria)
                                <span class="tag tag-categoria">{{ $categoria->nome }}</span>
                            @endforeach
                            @foreach($produto->marcas as $marca)
                                <span class="tag tag-marca">{{ $marca->nome }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="sem-resultados">
                <div class="sem-resultados-texto">Nenhum produto encontrado</div>
                <div class="sem-resultados-subtexto">
                    Tente ajustar os filtros de busca
                </div>
            </div>
        @endif
    </main>
    </div>
</div>
