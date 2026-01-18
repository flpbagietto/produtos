@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <div style="display: flex; justify-content: center; align-items: center; gap: 8px; flex-wrap: wrap;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span style="padding: 10px 16px; border-radius: 8px; background: #e2e8f0; color: #a0aec0; cursor: not-allowed; font-weight: 600;">
                    ‹ Anterior
                </span>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" style="padding: 10px 16px; border-radius: 8px; background: white; border: 2px solid #e2e8f0; color: #4a5568; cursor: pointer; font-weight: 600; transition: all 0.3s;" onmouseover="this.style.borderColor='#667eea'; this.style.color='#667eea';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#4a5568';">
                    ‹ Anterior
                </button>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span style="padding: 10px 12px; color: #a0aec0;">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span style="padding: 10px 16px; border-radius: 8px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: 700; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                                {{ $page }}
                            </span>
                        @else
                            <button wire:click="gotoPage({{ $page }})" style="padding: 10px 16px; border-radius: 8px; background: white; border: 2px solid #e2e8f0; color: #4a5568; cursor: pointer; font-weight: 600; transition: all 0.3s;" onmouseover="this.style.borderColor='#667eea'; this.style.color='#667eea'; this.style.transform='translateY(-2px)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#4a5568'; this.style.transform='translateY(0)';">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" style="padding: 10px 16px; border-radius: 8px; background: white; border: 2px solid #e2e8f0; color: #4a5568; cursor: pointer; font-weight: 600; transition: all 0.3s;" onmouseover="this.style.borderColor='#667eea'; this.style.color='#667eea';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#4a5568';">
                    Próxima ›
                </button>
            @else
                <span style="padding: 10px 16px; border-radius: 8px; background: #e2e8f0; color: #a0aec0; cursor: not-allowed; font-weight: 600;">
                    Próxima ›
                </span>
            @endif
        </div>
    </nav>
@endif

