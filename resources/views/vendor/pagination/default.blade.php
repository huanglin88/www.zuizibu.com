@if ($paginator->hasPages())
    <div class="page-navgator">
        <div class="page-con">
            @if ($paginator->onFirstPage())
                <a class="prevPage">上一页</a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">上一页</a>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <a class="prevPage">{{ $element }}</a>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="active">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">下一页</a>
            @else
                <a class="disabled">下一页</a>
            @endif
        </div>
    </div>
@endif

