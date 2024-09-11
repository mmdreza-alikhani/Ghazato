@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><a class="page-link" href="#">@lang('pagination.previous')</a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
            @endif
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">@lang('pagination.next')</a></li>
            @else
                <li class="page-item disabled"><a class="page-link" href="#">@lang('pagination.next')</a></li>
            @endif
        </ul>
    </nav>
@endif
