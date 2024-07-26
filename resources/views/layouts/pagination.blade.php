@if ($paginator->hasPages())
    <div wire:loading.remove>
        <div class="row">
            <div class="col-lg-6 text-lg-start text-center mb-lg-0 mb-3">
                <span>
                    Showing
                    {{ $paginator->firstItem() }}
                    to {{ $paginator->lastItem() }}
                    of {{ $paginator->total() }}
                    entries
                </span>
            </div>
            <div class="col-lg-6">
                <nav>
                    <ul class="pagination pagination-sm justify-content-lg-end justify-content-center">
                        @if ($paginator->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link text-dark"
                                    wire:click="setPage('{{ $paginator->previousPageUrl() }}')">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </li>
                        @endif
                        @foreach ($elements as $element)
                            @if (is_string($element))
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        {{ $element }}
                                    </span>
                                </li>
                            @endif
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link fw-bold">
                                                {{ $page }}
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link text-dark" wire:click="setPage('{{ $url }}')">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <a class="page-link text-dark" wire:click="setPage('{{ $paginator->nextPageUrl() }}')">
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link ">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endif
