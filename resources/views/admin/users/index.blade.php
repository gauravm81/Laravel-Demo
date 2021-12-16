@extends('layouts.app')

@section('content')

<div class="mx-auto px-4 sm:px-6 md:px-8">
    <h1 class="text-2xl font-semibold text-gray-900">Users</h1>

    @include ('shared.components.alert')

    <div class="flex flex-col">
        <div class="my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Id
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Name
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Email / Phone
                    </th>
                    
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider text-right">
                    Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ( $items as $item )
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-left">
                                    <div>
                                        <div class="text-sm leading-5 font-medium text-gray-900">{{$item->id}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                       @if ( $item->avatar )
                                            <img src="/storage/{{ $item->getThumbnailPath() }}" class="h-10 w-10 rounded-full">
                                        @else
                                            <div class="h-10 w-10 overflow-hidden rounded-full bg-gray-50 border border-gray-200">
                                                <svg class="h-auto w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm leading-5 font-medium text-gray-900">{{$item->first_name.' '.$item->last_name}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 font-medium text-gray-900">{{$item->email}}</div>
                                <div class="text-sm leading-5 text-gray-600">{{$item->phoneNiceFormat()}}</div>
                            </td>
                            
                            
                            
                            <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                <a href="{{route('admin.users.view', [$item->uuid])}}" class="text-gray-600 hover:text-teal-900 focus:outline-none focus:underline mr-4">Details</a>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>



    <div class="bg-white mt-3 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 shadow">
        {{ $items->links('shared.components.pagination') }}
    </div>
</div>



@endsection
