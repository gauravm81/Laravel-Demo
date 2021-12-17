<div id="successAlert" class="boost-success-alert border-t-4 border-2 p-4 mb-4 {{ empty($show) ? 'hidden' : '' }}">
  <div class="flex items-center">
    <div class="flex-shrink-0">
      <svg class="h-15 w-15" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
      </svg>
    </div>
    <h3 class="ml-4 text-2xl leading-6 font-medium">
      Success!
    </h3>
    <div class="px-4 text-sm leading-5 text-black">
      @if (!empty($messages))
        @foreach ($messages as $msg)
          <p>{!! $msg !!}</p>
        @endforeach
      @endif
    </div>
  </div>
</div>

<style>
  .boost-success-alert {
    color: #96C93D;
    background-color: rgba(150, 201, 61, 0.1);
    border-color: #96C93D;
  }
  .boost-success-alert p {
    color: black;
  }
</style>
