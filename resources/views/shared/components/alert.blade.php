@if ( Session::has('error') )
<div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
  <div class="flex">
    <div class="flex-shrink-0">
        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
    </div>
    <div class="ml-3">
      <h3 class="text-sm leading-5 font-medium text-red-800">
        Attention needed!
      </h3>
      <div class="mt-2 text-sm leading-5 text-red-700">
        {!! Session::get('error') !!}
      </div>
    </div>
  </div>
</div>
@endif
@if ( Session::get('status') == 'error' )
<div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
  <div class="flex">
    <div class="flex-shrink-0">
        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
    </div>
    <div class="ml-3">
      <h3 class="text-sm leading-5 font-medium text-red-800">
        Attention needed!
      </h3>
      <div class="mt-2 text-sm leading-5 text-red-700">
        @if ( $errors->all() )
        <ul>            
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @elseif( !empty(Session::get('message')) )
          {!! Session::get('message') !!}
        @endif
      </div>
    </div>
  </div>
</div>
@endif

@if ( Session::get('status') == 'info' )
<div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
  <div class="flex">
    <div class="flex-shrink-0">
        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
    </div>
    <div class="ml-3">
      <h3 class="text-sm leading-5 font-medium text-blue-800">
        Info!
      </h3>
      <div class="mt-2 text-sm leading-5 text-blue-700">
        <p>
          {!! Session::get('message') !!}
        </p>
      </div>
    </div>
  </div>
</div>
@endif
@if ( Session::has('success') )
<div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4">
  <div class="flex">
    <div class="flex-shrink-0">
        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
    </div>
    <div class="ml-3">
      <h3 class="text-sm leading-5 font-medium text-green-800">
        Success!
      </h3>
      <div class="mt-2 text-sm leading-5 text-green-700">
        <p>
          {!! Session::get('success') !!}
        </p>
      </div>
    </div>
  </div>
</div>
@endif
@if ( Session::get('status') == 'success' )
<div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4">
  <div class="flex">
    <div class="flex-shrink-0">
        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
    </div>
    <div class="ml-3">
      <h3 class="text-sm leading-5 font-medium text-green-800">
        Success!
      </h3>
      <div class="mt-2 text-sm leading-5 text-green-700">
        <p>
          {!! Session::get('message') !!}
        </p>
      </div>
    </div>
  </div>
</div>
@endif
