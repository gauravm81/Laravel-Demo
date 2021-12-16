@extends('layouts.app')

@section('content')


<div class="max-w-7xl mx-left px-4 sm:px-6 md:px-8">
    <form action="{{route('admin.batch.importcsv')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="border-b border-gray-200 px-4 py-3 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Batch Upload</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">

                @include ('shared.components.alert')

                <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="batch_upload" class="block text-sm font-medium leading-5 text-gray-700">
                            Batch Upload
                        </label>
                        <div class="mt-1 rounded-md shadow-sm  text-gray-500">
                            <input id="batch_upload" name="batch_upload" type="file" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            <a class="block text-sm font-medium leading-5 text-gray-500" href="{{asset('sample_batch.csv')}}">Download Sample File</a>
                        </div>
                        
                    </div>
                </div>

            </div>
            <div class="bg-gray-50 border-t border-gray-200  px-4 py-4 sm:px-6">
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
