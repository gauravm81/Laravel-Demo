<div id="errorAlert" class="boost-error-alert border-t-4 border-2 p-4 mb-4 hidden">
  <div class="flex items-center">
    <div class="flex-shrink-0">
      <svg class="h-15 w-15" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
      </svg>
    </div>
    <h3 class="ml-4 text-2xl leading-6 font-medium">
      Oops.
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
  .boost-error-alert {
    color: #D72337;
    background-color: rgba(215, 35, 55, 0.1);
    border-color: #D72337;
  }
</style>
