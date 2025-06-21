@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">

            {{-- 「前へ」ボタン --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled arrow" aria-disabled="true" aria-label="Previous">
                    <span class="page-link" aria-hidden="true">＜</span>
                </li>
            @else
                <li class="page-item arrow">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">＜</a>
                </li>
            @endif

            {{-- ページ番号 --}}
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                @if ($i == $paginator->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $i }}</span>
                    </li>
                @elseif ($i <= 10 || $i > $paginator->lastPage() - 2)
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @elseif ($i == 11)
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">...</span>
                    </li>
                @endif
            @endfor

            {{-- 「次へ」ボタン --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">＞</a>
                </li>
            @else
                <li class="page-item disabled arrow" aria-disabled="true" aria-label="Next">
                    <span class="page-link arrow" aria-hidden="true">＞</span>
                </li>
            @endif

        </ul>
    </nav>
@endif