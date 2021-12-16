
@if ( $type == 'success' )
<button id="{{$id ?? ''}}" type="button" class="justify-center w-full rounded-sm px-6 py-4 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:shadow-outline transition ease-in-out duration-150">{{$text}}</button>
@endif

@if ( $type == 'danger' )
<button id="{{$id ?? ''}}" type="button" class="justify-center w-full rounded-sm px-6 py-4 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:shadow-outline transition ease-in-out duration-150">{{$text}}</button>
@endif