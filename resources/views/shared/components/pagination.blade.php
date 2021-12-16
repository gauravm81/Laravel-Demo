<div class="hidden sm:block">
    <p class="text-sm leading-5 text-gray-700">
    Showing
    <span class="font-medium">{{ (($paginator->currentPage()-1) * $paginator->perPage()) + 1 }}</span>
    to 
    <span class="font-medium">
        @if ($paginator->lastPage() > $paginator->currentPage() )
        {{ (($paginator->currentPage()) * $paginator->perPage()) }}
        @else
        {{ ($paginator->total()) }}
        @endif
    </span>
    of
    <span class="font-medium">{{$paginator->total()}}</span>
    results
    </p>
</div>
<div class="flex-1 flex justify-between sm:justify-end">

    
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-300 bg-gray-50 transition ease-in-out duration-150 cursor-not-allowed">
            Previous
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
            Previous
        </a>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
        Next
    </a>
    @else
    <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-300 bg-gray-50 transition ease-in-out duration-150 cursor-not-allowed">
        Next
    </span>
    @endif
</div>

