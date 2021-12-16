@extends('layouts.auth')

@section('content')

<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    
    <h2 class="mt-6 text-center text-3xl leading-9 font-bold text-cool-gray-700">
      Forgot Password
    </h2>
  </div>

  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-lg">
    <div class="bg-white py-8 px-4 border border-cool-gray-200 shadow-lg sm:rounded-lg sm:px-10">
        <form method="POST" action="{{ route('password.email') }}">
        @csrf
        
        @if (session('status'))
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
                        <p>{{ session('status') }}</p>
                    </div>
                    </div>
                </div>
            </div>
        @endif

        <div>
          <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
            Email address
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input aria-label="Email address" id="email" name="email" type="email" required class="appearance-none block w-full px-3 py-4 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email address" autofocus />
                @error('email')
                    <span class="invalid-feedback text-red-700 text-sm font-semibold" role="alert">{{ $message }}</span>
                @enderror
          </div>
        </div>

        <div class="mt-6">
          <span class="block w-full rounded-md shadow-sm">
            <button type="submit" class="w-full flex justify-center px-6 py-4 border border-transparent font-medium text-lg rounded-md text-white bg-teal-500 hover:bg-teal-400 focus:outline-none focus:border-teal-600 focus:shadow-outline-teal active:bg-teal-600 transition duration-150 ease-in-out">
              Send Password Reset Link
            </button>
          </span>
        </div>
  
        <div class="mt-3 text-center justify-between">
          <div class="text-sm leading-5">
            @if (Route::has('password.request'))
                <a class="font-medium text-cool-gray-600 hover:text-cool-gray-500 focus:outline-none focus:underline transition ease-in-out duration-150" href="{{ route('login') }}">
                    <span class="text-teal-500">Sign in here!</span>
                </a>
            @endif
          </div>
        </div>
      </form>

    </div>
  </div>
</div>


@endsection
