<style>
    .pagination {
        display: flex;
        justify-content: center;
    }

    .pagination a {
        border-radius: 50%
        padding: 8px 16px;
        text-decoration: none;
        color: #818181;
        border: 1px solid #ddd;
    }

    .pagination .active {
         
        padding:5px 14px;
        background-color: #4CAF50;
        color: white;
        /* border: 1px solid #4CAF50; */
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
</style>

<ul class="pagination">

    @if ($paginator->onFirstPage())
        <li class="pageitem disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <a class="page-link" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
    @else
        <li class="pageitem">
            <a class="page-link" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
        <li class="pageitem disabled" aria-disabled="true"><span>{{ $element }}</span></li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
        @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
                <li class="pageitem active" aria-current="page"><span>{{ $page }}</span></li>
            @else
                <li class="pageitem"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach
    @endif
@endforeach


@if ($paginator->hasMorePages())
<li class="pageitem">
    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
</li>
@else
<li class="pageitem">
    <a class="page-link" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
</li>
@endif
   
</ul>
