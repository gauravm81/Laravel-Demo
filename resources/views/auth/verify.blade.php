@extends('layouts.auth')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <img class="mx-auto h-12 w-auto" src="/images/logo-square.svg" alt="Boostable.media" />
    <h2 class="mt-6 text-center text-3xl leading-9 font-bold text-cool-gray-700">
      Boostable.media
    </h2>
  </div>

  <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
    <div class="bg-white py-10 pb-16 px-4 border border-cool-gray-200 shadow-lg sm:rounded-lg sm:px-10 text-center">

        <div class="mb-4 w-20 h-20 text-cool-gray-400 mx-auto">
            <svg fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
        </div>

        <div>
            @if (session('resent'))
                <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4 text-left">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                        <p>A fresh verification link has been sent to your email address.</p>
                        </div>
                    </div>
                </div>
            @endif

            <p class="text-cool-gray-700 leading-6 font-medium">Before proceeding, please check your email for a verification link.</p>
            <p class="pb-10">If you did not receive the email, click on the button below.</p>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <div class="text-center">
                    <span class="inline-block justify-center rounded-md shadow-sm">
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base leading-6 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150">
                            Resend Verification Email
                        </button>
                    </span>
                </div>
            </form>
            
        </div>

    </div>
  </div>
</div>
@endsection
