@if ($paginator->hasPages())
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <a class="page-prev" href="javascript:;" data-href="#">previous</a>
    @else
        <a class="paginate page-prev {{$class}}" href="javascript:;" data-href="{{ $paginator->previousPageUrl() }}">previous</a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a class="paginate active {{$class}}" href="javascript:;" data-href="#">{{ $page }}</a>
                @else
                    <a class="paginate {{$class}}" href="javascript:;" data-href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a class="paginate page-next {{$class}}" href="javascript:;" data-href="{{ $paginator->nextPageUrl() }}">Next</a>
    @else
        <a class="paginate page-next {{$class}}" href="javascript:;" data-href="{{ $paginator->nextPageUrl() }}">Next</a>
    @endif
@endif
