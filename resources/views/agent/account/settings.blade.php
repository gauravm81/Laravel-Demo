@extends('layouts.app')

@section('content')


<div class="max-w-7xl mx-left px-4 sm:px-6 md:px-8">
    <form action="{{route('agent.settings.update')}}" method="POST" autocomplete="off">
        @csrf

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="border-b border-gray-200 px-4 py-3 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Settings</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                
                
                @include ('shared.components.alert')
                
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Account settings
                    </h3>
                    <p class="mt-1 text-sm leading-5 text-gray-500">
                    Use a permanent address where you can receive mail.
                    </p>
                </div>
                <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                        <span class="text-red-500">* </span>Email address (username)
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="email" name="current_email" required="required" type="email" value="{{ old('email') ?? $user->email }}" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    </div>
            
                    <div class="sm:col-span-3">
                    <label for="email_confirmation" class="block text-sm font-medium leading-5 text-gray-700">
                        <span class="text-red-500">* </span>Confirm email address
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="email_confirmation" name="current_email_confirmation" type="email" value="" required="required" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    </div>
                    
                    <div class="sm:col-span-3">
                    <label for="password" required="required" class="block text-sm font-medium leading-5 text-gray-700">
                        <span class="text-red-500">* </span>New password
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="password" name="new_password" value="" type="password" required="required" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    </div>
            
                    <div class="sm:col-span-3">
                    <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">
                        <span class="text-red-500">* </span>Confirm new password
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="password_confirmation" name="new_password_confirmation" value="" type="password" required="required" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                    </div>

                </div>

            </div>
            <div class="bg-gray-50 px-4 py-4 sm:px-6">
                
                <div class="flex justify-end">
                    
                    <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-teal-600 hover:bg-teal-500 focus:outline-none focus:border-teal-700 focus:shadow-outline-teal active:bg-teal-700 transition duration-150 ease-in-out">
                        Save
                    </button>
                    </span>
                </div>

            </div>
        </div>
    </form>
</div>


@endsection
