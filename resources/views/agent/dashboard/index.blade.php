@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-left px-4 sm:px-6 md:px-8">
	<div class="bg-white overflow-hidden mb-4">
		<h2 class="text-2xl text-gray-700 font-medium">Get Started</h2>
		<span class="block mt-2 mb-5 bg-primary" style="width: 123px;height: 2px; color: #03beb6 !important;"></span>
	</div>
	<div class="bg-white overflow-hidden mb-4">
		<div class="bg-white py-2 border-b border-gray-200">
			<h3 class="text-lg leading-6 font-medium text-gray-900">Welcome to Dashboard</h3>
		</div>
		<p class="mt-4 text-sm leading-5 text-gray-500 mb-6">Hello there! We'd like to welcome you to the Dummy Site team. <br>Below are a few items that will help you get the most out of your account. Again, welcome aboard! </p>
	</div>
	@if(!$notifications->isEmpty())
		<div class="bg-white overflow-hidden mb-4">
			<h3 class="text-lg leading-6 font-medium text-gray-900 mb-6">Attention Needed</h3>
			@foreach ( $notifications as $error)
				<div class="bg-warning-50 max-w-3xl border-l-6 border-warning-400 p-3 mb-3 ml-5">
					  <div class="flex">
						<div class="flex-shrink-0">
							<svg class="h-6 w-6 mt-3 text-warning-400" viewBox="0 0 24 24" fill="currentColor">
								  <polygon points="12 2, 22 22, 2 22" />
								  <line x1="12" y1="10" x2="12" y2="14" stroke="white" stroke-width="3" stroke-linecap="butt"/>
								  <circle cx="12" cy="18" r="0.5" stroke="white" stroke-width="3" />
							</svg>
						</div>
						<div class="ml-3">
						  <h3 class="text-sm leading-4 mt-1 font-medium text-black-900">
							{{$error->title}}
						   </h3>
						  <div class="mt-2 text-sm leading-3 mb-1 text-black-700">
							{{$error->message}}
						  </div>
						</div>
					  </div>
					</div>
			@endforeach
		</div>
	@endif

	

</div>
<style>
.bg-warning-50{--bg-opacity:1;background-color:#fdecc3;background-color:rgba(253,236,195,var(--bg-opacity))}
.border-warning-400 { --border-opacity: 1; border-color: #fab813; border-color: rgba(250,184,19,var(--border-opacity));}
.border-l-6{border-left-width:6px}
.text-warning-400 { --text-opacity: 1;  color: #fab813;color: rgba(250,184,19,var(--text-opacity));}
.bg-primary {
    background-color: #0BC3BB !important;
}
</style>
@endsection

