@extends('layouts.auth')

@section('content')


<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <h2 class="mt-6 text-center text-3xl leading-9 font-bold text-cool-gray-700">
      New User Register
    </h2>
  </div>

  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-lg">
    <div class="bg-white py-8 px-4 border border-cool-gray-200 shadow-lg sm:rounded-lg sm:px-10">
      <form class="mt-2" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 row-gap-0 col-gap-4 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">
              <span class="text-red-500">* </span>First Name
            </label>
            <div class="mt-1 rounded-md shadow-sm">
              <input aria-label="First Name" id="first_name" name="first_name" type="text" required class="appearance-none block w-full px-3 py-4 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" placeholder="First Name" autofocus />
                @error('first_name')
                    <span class="invalid-feedback text-red-700 text-sm font-semibold" role="alert">{{ $message }}</span>
                @enderror
            </div>
          </div>
          <div class="sm:col-span-3 mt-6 sm:mt-0">
            <label for="last_name" class="block text-sm font-medium leading-5 text-gray-700">
              <span class="text-red-500">* </span>Last Name
            </label>
            <div class="mt-1 rounded-md shadow-sm">
              <input aria-label="Last Name" id="last_name" name="last_name" type="text" required class="appearance-none block w-full px-3 py-4 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" placeholder="Last Name" autofocus />
                @error('last_name')
                    <span class="invalid-feedback text-red-700 text-sm font-semibold" role="alert">{{ $message }}</span>
                @enderror
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 row-gap-0 col-gap-4 sm:grid-cols-6 mt-6">
          <div class="sm:col-span-3">
             <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
				<span class="text-red-500">* </span>Email address
			  </label>
            <div class="mt-1 rounded-md shadow-sm">
              <input aria-label="Email address" id="email" name="email" type="email" required class="appearance-none block w-full px-3 py-4 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Email address" autofocus />
                @error('email')
                    <span class="invalid-feedback text-red-700 text-sm font-semibold" role="alert">{{ $message }}</span>
                @enderror
            </div>
          </div>
          <div class="sm:col-span-3 mt-6 sm:mt-0">
            <label for="phone" class="block text-sm font-medium leading-5 text-gray-700">
				<span class="text-red-500">* </span>Phone
			</label>
            <div class="mt-1 rounded-md shadow-sm">
              <input aria-label="Email address" id="phone" name="phone" type="text" required class="appearance-none block w-full px-3 py-4 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Phone" autofocus />
                @error('phone')
                    <span class="invalid-feedback text-red-700 text-sm font-semibold" role="alert">{{ $message }}</span>
                @enderror
            </div>
          </div>
        </div>

        <div class="mt-6">
          <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
            <span class="text-red-500">* </span>Password
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input aria-label="Password" id="password" name="password" type="password" required class="appearance-none block w-full px-3 py-4 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') is-invalid @enderror" placeholder="Password" autocomplete="current-password" />
                @error('password')
                    <span class="invalid-feedback text-red-700 text-sm font-semibold" role="alert">{{ $message }}</span>
                @enderror
          </div>
        </div>

        <div class="mt-6">
          <label for="password_confirm" class="block text-sm font-medium leading-5 text-gray-700">
            <span class="text-red-500">* </span>Confirm Password
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input aria-label="Password Confirmation" id="password_confirm" name="password_confirmation" type="password" required class="appearance-none block w-full px-3 py-4 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                @error('password_confirmation')
                    <span class="invalid-feedback text-red-700 text-sm font-semibold" role="alert">{{ $message }}</span>
                @enderror
          </div>
        </div>


        <div class="mt-6">
          <span class="block w-full rounded-md shadow-sm">
            <button type="submit" class="w-full flex justify-center px-6 py-4 border border-transparent font-medium text-lg rounded-md text-white bg-teal-500 hover:bg-teal-400 focus:outline-none focus:border-teal-600 focus:shadow-outline-teal active:bg-teal-600 transition duration-150 ease-in-out">
              Start Free Trial
            </button>
          </span>
        </div>
  
        <div class="mt-3 text-center justify-between">
          <div class="text-sm leading-5">
            @if (Route::has('password.request'))
                <a class="font-medium text-cool-gray-600 hover:text-cool-gray-500 focus:outline-none focus:underline transition ease-in-out duration-150" href="{{ route('login') }}">
                    Already have an account? <span class="text-teal-500">Sign in here!</span>
                </a>
            @endif
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

@endsection
