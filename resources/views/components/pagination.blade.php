@props([
'paginator' => \Illuminate\Pagination\LengthAwarePaginator::class,
])

@if ($paginator->hasPages())
<ul class="pagination d-flex align-items-center">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
    <li class="pagination-page disabled">
        <span class="pagination-page_link d-flex align-items-center justify-content-center">&laquo;</span>
    </li>
    @else
    <li class="pagination-page">
        <a class="pagination-page_link d-flex align-items-center justify-content-center"
            href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
    </li>
    @endif

    {{-- Page Number Links --}}
    @for ($page = 1; $page <= $paginator->lastPage(); $page++)
        @if ($page == $paginator->currentPage())
        <li class="pagination-page">
            <a class="pagination-page_link d-flex align-items-center justify-content-center"
                href="#" data-current="true">{{ $page }}</a>
        </li>
        @else
        <li class="pagination-page">
            <a class="pagination-page_link d-flex align-items-center justify-content-center"
                href="{{ $paginator->url($page) }}">{{ $page }}</a>
        </li>
        @endif
        @endfor

        {{-- Next --}}
        @if ($paginator->hasMorePages())
        <li class="pagination-page">
            <a class="pagination-page_link d-flex align-items-center justify-content-center"
                href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
        </li>
        @else
        <li class="pagination-page disabled">
            <span class="pagination-page_link d-flex align-items-center justify-content-center">&raquo;</span>
        </li>
        @endif
</ul>
@endif