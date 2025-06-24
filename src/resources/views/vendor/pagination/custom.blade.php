@if ($paginator->hasPages())
    <nav class="pagination">
        {{-- 前のページ --}}
        @if ($paginator->onFirstPage())
            <span class="page-link disabled">‹</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link">‹</a>
        @endif

        {{-- ページ番号 --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="page-link disabled">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- 次のページ --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link">›</a>
        @else
            <span class="page-link disabled">›</span>
        @endif
    </nav>
@endif