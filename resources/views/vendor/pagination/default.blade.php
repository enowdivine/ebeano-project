@if ($paginator->hasPages())
<div class="list-pagination my-3">
<ul class="page">
   
    @if ($paginator->onFirstPage())
        <li class="page_btn disabled"><span class="material-icons">chevron_left</span></li>
    @else
        <li class="page__btn" ><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><span class="material-icons">chevron_left</span></a></li>
    @endif


  
    @foreach ($elements as $element)
       
        @if (is_string($element))
            <li class="page__dots"><span>{{ $element }}</span></li>
        @endif


       
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page__numbers active"><span>{{ $page }}</span></li>
                @else
                    <li class="page__numbers"><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach


    
    @if ($paginator->hasMorePages())
        <li class="page__btn" ><a href="{{ $paginator->nextPageUrl() }}" rel="next"><span class="material-icons">chevron_right</span><</a></li>
    @else
        <li class="page__btn disabled"><span class="material-icons">chevron_right</span><</li>
    @endif
</ul>
</div>
@endif
