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
                    <?php $__empty_1 = true; $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="checkbox-item">
                            <input 
                                type="checkbox" 
                                id="categoria_<?php echo e($categoria->id); ?>" 
                                wire:model.live="categoriasSelecionadas"
                                value="<?php echo e((string)$categoria->id); ?>"
                            >
                            <label for="categoria_<?php echo e($categoria->id); ?>"><?php echo e($categoria->nome); ?></label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div style="padding: 12px; color: #999; font-size: 13px;">
                            <?php if(!empty($buscaCategoria)): ?>
                                Nenhuma categoria encontrada para "<?php echo e($buscaCategoria); ?>"
                            <?php else: ?>
                                Nenhuma categoria disponível
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
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
                    <?php $__empty_1 = true; $__currentLoopData = $marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="checkbox-item">
                            <input 
                                type="checkbox" 
                                id="marca_<?php echo e($marca->id); ?>" 
                                wire:model.live="marcasSelecionadas"
                                value="<?php echo e((string)$marca->id); ?>"
                            >
                            <label for="marca_<?php echo e($marca->id); ?>"><?php echo e($marca->nome); ?></label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div style="padding: 12px; color: #999; font-size: 13px;">
                            <?php if(!empty($buscaMarca)): ?>
                                Nenhuma marca encontrada para "<?php echo e($buscaMarca); ?>"
                            <?php else: ?>
                                Nenhuma marca disponível
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <button type="button" wire:click="limparFiltros" wire:loading.attr="disabled" class="btn-limpar">
                <span wire:loading.remove wire:target="limparFiltros">Limpar filtros</span>
                <span wire:loading wire:target="limparFiltros">Limpando...</span>
            </button>
        </div>
    </aside>

    <main class="content-area">
        <?php if($produtos->count() > 0): ?>
            <div class="results-header">
                <div class="results-count">
                    <strong><?php echo e($produtos->count()); ?></strong> produto<?php echo e($produtos->count() > 1 ? 's' : ''); ?> encontrado<?php echo e($produtos->count() > 1 ? 's' : ''); ?>

                </div>
            </div>

            <div class="produtos-grid">
                <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="produto-card">
                        <div class="produto-nome"><?php echo e($produto->nome); ?></div>
                        <?php if($produto->descricao): ?>
                            <div class="produto-descricao"><?php echo e($produto->descricao); ?></div>
                        <?php endif; ?>
                        <div class="produto-tags">
                            <?php $__currentLoopData = $produto->categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="tag tag-categoria"><?php echo e($categoria->nome); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $produto->marcas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="tag tag-marca"><?php echo e($marca->nome); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="sem-resultados">
                <div class="sem-resultados-texto">Nenhum produto encontrado</div>
                <div class="sem-resultados-subtexto">
                    Tente ajustar os filtros de busca
                </div>
            </div>
        <?php endif; ?>
    </main>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/busca-produtos.blade.php ENDPATH**/ ?>