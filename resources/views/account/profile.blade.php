@extends('layouts.app')

@section('content')


<div class="max-w-7xl mx-left px-4 sm:px-6 md:px-8">
    <form action="{{route('agent.profile.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="profile_form" value="form_agent_info">
        <input type="hidden" name="profile_user" value="{{ $user->uuid }}">
		
		 <div class="bg-white overflow-hidden mb-4">
            @include('agent.onboarding.title', ['title' => 'Build your Agent Profile'])
            <div class="px-4 py-5 sm:p-3">
				@if ( Session::get('message_type') == 'profile_form' )
                @include ('shared.components.alert')
                @endif
               <div id="userlicense">
					<div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
						<div class="sm:col-span-2">
							<label for="license_number" class="block text-sm font-medium leading-5 text-gray-700">
								License Type
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<select id="license_name" name="license_name" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
									
									@if ( old('license_name') )
										<option value="Sales Agent" {{ (old('license_state') == 'Sales Agent') ? 'selected="selected"' : '' ?? '' }}>Sales Agent</option>
									@else
										<option value="Sales Agent" {{ ( isset($agent) && $agent->license_name == 'Sales Agent') ? 'selected="selected"' : '' }}>Sales Agent</option>
									@endif
									@if ( old('license_name') )
									<option value="Broker" {{ (old('license_state') == 'Broker') ? 'selected="selected"' : '' ?? '' }}>Broker</option>
									@else
										<option value="Broker" {{ ( isset($agent) && $agent->license_name == 'Broker') ? 'selected="selected"' : '' }}>Broker</option>
									@endif
									@if ( old('license_name') )
									<option value="Broker Associate" {{ (old('license_state') == 'Broker Associate') ? 'selected="selected"' : '' ?? '' }}>Broker Associate</option>
									@else
										<option value="Broker Associate" {{ ( isset($agent) && $agent->license_name == 'Broker Associate') ? 'selected="selected"' : '' }}>Broker Associate</option>
									@endif	
								</select>
							</div>
						</div>
						<div class="sm:col-span-2">
							<label for="license_number" class="block text-sm font-medium leading-5 text-gray-700">
								<span class="text-red-500">* </span>License #
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="license_number" name="license_number" value="{{$agent->license_number ?? old('license_number')}}" required class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
							</div>
						</div>
						<div class="sm:col-span-2">
							<label for="license_state" class="block text-sm font-medium leading-5 text-gray-700">
								<span class="text-red-500">* </span>State
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<select id="license_state" name="license_state" name="type" required class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
									<option value="">Select State</option>
									@foreach (App\Http\Helpers\HelperForms::getStatesList() as $key => $val)
										@if ( old('license_state') )
										<option value="{{$key}}" {{ (old('license_state') == $key) ? 'selected="selected"' : '' ?? '' }}>{{$val}}</option>
										@else
										<option value="{{$key}}" {{ ( isset($agent) && $agent->license_state == $key) ? 'selected="selected"' : '' }}>{{$val}}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
        <div class="bg-white overflow-hidden mb-4">
			@include('agent.onboarding.title', ['title' => 'Broker License'])
			<div class="px-4 py-5 sm:p-3">
				<div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
						<div class="sm:col-span-2">
							<label for="brokerage_name" class="block text-sm font-medium leading-5 text-gray-700">
								<span class="text-red-500">* </span>Brokerage Name
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="brokerage_name" name="brokerage_name" value="{{$agent->brokerage_name ?? old('brokerage_name')}}" required class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
							</div>
						</div>
						<div class="sm:col-span-2">
							<label for="broker_license_number" class="block text-sm font-medium leading-5 text-gray-700">
								Broker License Number
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="broker_license_number" name="broker_license_number" value="{{$agent->brokerage_license ?? old('broker_license_number')}}" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
							</div>
						</div>
						<div class="sm:col-span-2">
							<label for="broker_email" class="block text-sm font-medium leading-5 text-gray-700">
								<span class="text-red-500">* </span>Broker Email
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="broker_email" name="broker_email" value="{{$agent->brokerage_email ?? old('broker_email')}}" required class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
							</div>
						</div>
					</div>
			</div>	
		</div>
		<div class="bg-white overflow-hidden mb-4">
				@include('agent.onboarding.title', ['title' => 'Photo Profile'])
			<div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-12">
				<div class="sm:col-span-6">
					<div class="sm:col-span-12 ml-5">
						<div class="flex items-center">
							<span class="h-36 w-36 overflow-hidden bg-gray-100 relative">
								@if ( Auth::user()->avatar ) 
									<img id="avatar" src="/storage/{{Auth::user()->getThumbnailPath('180x180')}}" class="w-38 h-auto -ml-4 -mt-4 max-w-none absolute top-0 right-0 bottom-0 left-0">
									<svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
									<input id="avatarval" name="avatarfile"  type="hidden" value="{{Auth::user()->avatar}}" />
								@elseif(!empty($image_url))
									<img id="avatar" src="{{$image_url}}" class="w-38 h-auto -ml-4 -mt-4 max-w-none absolute top-0 right-0 bottom-0 left-0">
									<svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
									 <input id="avatarval" name="avatarfile"  type="hidden" value="{{$image_url}}" />
								@else
									<img id="avatar" src="" class="w-38 h-auto -ml-4 -mt-4 max-w-none absolute top-0 right-0 bottom-0 left-0">
									<svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
									<input id="avatarval" name="avatarfile"  type="hidden" value="" />
								@endif
							</span>
						</div>
					</div>
					<div class="sm:col-span-12 mt-5"> 
						 <div class="flex items-center">
							<span class="ml-5 rounded-md shadow-sm">
								<input id="field_Avatar" name="avatar" data-img="#avatar" type="file" style="display:none;" />
								
								<button type="button" class="py-2 px-6 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out ml-3" style="border:2px solid #0BC3BB;color:#0BC3BB" onclick="document.getElementById('field_Avatar').click();">Upload</button>
								<button type="button" class="py-2 px-6 border border-gray-700 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out" onclick="remove_Avatar()">Delete</button>
							</span>
						</div>
					</div>
				
				</div>
			
				<div class="sm:col-span-6">
					<div class="mt-1 mb-4 sm:mt-0 sm:col-span-2">
						<div class="max-w-lg flex rounded-md shadow-sm">
						  <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
							facebook.com/
						  </span>
						  <input type="text" name="facebook" id="facebook" value="{{$user->facebook ?? old('facebook')}}" class="form-input flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
							<label for="facebook" class="block ml-5 text-sm font-medium text-gray-700">
								Facebook
							</label>
						</div>
					</div>	
					<div class="mt-1 mb-4 sm:mt-0 sm:col-span-2">
						<div class="max-w-lg flex rounded-md shadow-sm">
						  <span class="inline-flex items-center px-5 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
							twitter.com/
						  </span>
						  <input type="text" name="twitter" id="twitter" value="{{$user->twitter ?? old('twitter')}}" class="form-input flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
							<label for="twitter" class="block ml-5 text-sm font-medium text-gray-700">
								Twitter&nbsp;&nbsp;&nbsp;
							</label>
						</div>
					 </div>	
						<div class="mt-1 mb-4 sm:mt-0 sm:col-span-2">
							<div class="max-w-lg flex rounded-md shadow-sm">
							  <span class="inline-flex items-center px-4 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
								linkedin.com/
							  </span>
							  <input type="text" name="linkedin" id="linkedin" value="{{$user->linkedin ?? old('linkedin')}}" autocomplete="linkedin" class="form-input flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
								<label for="linkedin" class="block ml-5 text-sm font-medium text-gray-700">
									LinkedIn
								</label>
							</div>
						</div>	
						<div class="mt-1 sm:mt-0 sm:col-span-2">
							<div class="max-w-lg flex rounded-md shadow-sm">
							  <input type="text" name="website" id="website" value="{{$user->website ?? old('website')}}"  autocomplete="website" class="form-input flex-1 block w-full focus:ring-indigo-500 focus:border-indigo-500 min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Website Name">
								<label for="company-website" class="block ml-5 text-sm font-medium text-gray-700">
									Website
								</label>
							</div>
					 </div>
				</div>	
			</div>
        </div>    
       
        <div class="bg-white overflow-hidden mb-4">
			@include('agent.onboarding.title', ['title' => 'Brokerage Logo'])
			<div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-12">
				<div class="sm:col-span-12 ml-5">
					<div class="flex items-center">
						<span class="h-36 w-36 overflow-hidden bg-gray-100 relative">
							@if ( isset($agent->brokerage_logo) && !empty($agent->brokerage_logo) ) 
								<img id="brokerage_avatar" src="/storage/{{$agent->getThumbnailPath('180x180')}}" class="w-38 h-auto -ml-4 -mt-4 max-w-none absolute top-0 right-0 bottom-0 left-0">
								<svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
								<input id="brokerage_avatarval" name="brokerage_avatarval"  type="hidden" value="{{$agent->brokerage_logo}}" />
							@elseif(!empty($image_url))
								<img id="brokerage_avatar" src="{{$image_url}}" class="w-38 h-auto -ml-4 -mt-4 max-w-none absolute top-0 right-0 bottom-0 left-0">
								 <input id="brokerage_avatarval" name="brokerage_avatarval"  type="hidden" value="{{$image_url}}" />
							@else
								<img id="brokerage_avatar" src="" class="w-38 h-auto -ml-4 -mt-4 max-w-none absolute top-0 right-0 bottom-0 left-0">
								<svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
								<input id="brokerage_avatarval" name="brokerage_avatarval"  type="hidden" value="" />
							@endif
						</span>
					 </div>	
				 </div>	
				 <div class="sm:col-span-12 mt-5"> 
					 <div class="flex items-center">
						<span class="ml-5 rounded-md shadow-sm">
							<input id="field_brokerage_Avatar" name="brokerage_avatar" data-img="#brokerage_avatar" type="file" style="display:none;" />
							
							<button type="button" class="py-2 px-6 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out ml-3" style="border:2px solid #0BC3BB;color:#0BC3BB" onclick="document.getElementById('field_brokerage_Avatar').click();">Upload</button>
							<button type="button" class="py-2 px-6 border border-gray-700 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out" onclick="remove_brokerage_Avatar()">Delete</button>
						</span>
					</div>
				</div>
			</div>	
		</div>	
			
        <div class="bg-white overflow-hidden mt-2 mb-4">
            @include('agent.onboarding.title', ['title' => 'Contact Info'])
				<div class="px-4 py-5 sm:p-6">
					<div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
						<div class="sm:col-span-2 ">
							<label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">
								<span class="text-red-500">* </span>First name
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="first_name" name="first_name" value="{{$user->first_name ?? old('first_name')}}" required="required" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
							</div>
						</div>
				
						<div class="sm:col-span-2">
							<label for="last_name" class="block text-sm font-medium leading-5 text-gray-700">
								<span class="text-red-500">* </span>Last name
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="last_name" name="last_name" value="{{$user->last_name ?? old('last_name')}}" required="required" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
							</div>
						</div>
						<div class="sm:col-span-2">
							<label for="last_name" class="block text-sm font-medium leading-5 text-gray-700">
								Professional Designations
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="pro_designation" name="pro_designation" value="{{$agent->professional_designations ?? old('pro_designation')}}" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
							</div>
						</div>
				
						<div class="sm:col-span-4">
							<label for="address" class="block text-sm font-medium leading-5 text-gray-700">
								Street Address
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="address" name="address" value="{{$user->street ?? old('street')}}" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
							</div>
						</div>
				
						<div class="sm:col-span-2">
							<label for="suite" class="block text-sm font-medium leading-5 text-gray-700">
								Suite 
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="suite" name="suite" value="{{$user->suite ?? old('suite')}}" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
							</div>
						</div>
				
						<div class="sm:col-span-2">
						<label for="city" class="block text-sm font-medium leading-5 text-gray-700">
							<span class="text-red-500">* </span>City
						</label>
						<div class="mt-1 rounded-md shadow-sm">
							<input id="city" name="city" value="{{$user->city ?? old('city')}}" required="required" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
						</div>
						</div>
				
						<div class="sm:col-span-2">
						<label for="state" class="block text-sm font-medium leading-5 text-gray-700">
							<span class="text-red-500">* </span>State / Province
						</label>
						<div class="mt-1 rounded-md shadow-sm">
							<select id="state" name="state" name="type" class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" required>
								<option value="">Select State</option>
								@foreach (App\Http\Helpers\HelperForms::getStatesList() as $key => $val)
									@if ( old('state') )
									<option value="{{$key}}" {{ (old('state') == $key) ? 'selected="selected"' : '' ?? '' }}>{{$val}}</option>
									@else
									<option value="{{$key}}" {{ ($user->state == $key) ? 'selected="selected"' : '' }}>{{$val}}</option>
									@endif
								@endforeach
							</select>
						</div>
						</div>
				
						<div class="sm:col-span-2">
							<label for="zipcode" class="block text-sm font-medium leading-5 text-gray-700">
								ZIP / Postal
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="zipcode" name="zipcode" value="{{$user->zipcode ?? old('zipcode')}}" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
							</div>
						</div>
						
						 <div class="sm:col-span-2">
							<label for="phone" class="block text-sm font-medium leading-5 text-gray-700">
								<span class="text-red-500">* </span>Phone Number
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="phone" name="phone" type="text" value="{{$user->phone ?? old('phone')}}" required="required" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
							</div>
						</div>
						<div class="sm:col-span-2">
							<label for="email" class="block text-sm font-medium leading-5 text-gray-700">
								Office Contact
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="office_contact" name="office_contact" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" value="{{$user->office_contact ?? old('office_contact')}}"  />
							</div>
                        </div>
						<div class="sm:col-span-2">
							<label for="email" class="block text-sm font-medium leading-5 text-gray-700">
								<span class="text-red-500">* </span>Login Email
							</label>
							<div class="mt-1 rounded-md shadow-sm">
								<input id="email" name="email" type="email" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" value="{{$user->email ?? old('email')}}"  />
							</div>
                        </div>
            
                   
					</div>
				</div>
			
            </div>

       
        
        <div class="bg-white overflow-hidden mt-2 mb-4">
            @include('agent.onboarding.title', ['title' => 'About'])
            <div class="mt-2 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
				<div class="sm:col-span-6">
					<div class="mt-1 rounded-md shadow-sm">
						<textarea name="about" id="about" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" cols="30" rows="10" placeholder="Enter details about you: background,interests etc">{{$agent->about ?? old('about')}}</textarea>
					</div>
				</div>
			</div>
        </div>    
        
        
		<div class="bg-white overflow-hidden">
             @include('agent.onboarding.title', ['title' => 'Areas Served'])
            <div class="px-4 py-5 sm:p-6" id="localize">
                <div>
                    <div>
                        <p class="mt-1 text-sm leading-5 text-gray-500">Select area that you prefer to do business and want displayed on your profile page. Locations will be <br>quick links to the search results page for that area.</p>
                    </div>
                    <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <div class="mt-1 rounded-md shadow-sm relative">
                                <input id="uzpcatcmp" name="uzpcatcmp" autocomplete="nope" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-cool-gray-400 focus:outline-none focus:shadow-none" placeholder="Select your areas served here""/>
                                <input type="hidden" name="maxAgentSocialZipcodes" id="maxAgentSocialZipcodes" value="{{ $user_preferences->zipcodes_limit ?? 1 }}">

                                <div id="searchResultsAreasServedDropdown" class="absolute px-4 py-4 w-full top-8 shadow-sm rounded-sm bg-white border-b border-l border-r border-cool-gray-400" style="display: none">
                                    <ul class="leading-8">
                                    </ul>
                                </div>
                            </div>

                            <div id="areasServedContainer" class="mt-4">
                                @foreach ( Auth::user()->zipcodes as $z)
                                    <input id="id_{{$z->city_id}}" type="hidden" name="user_zipcodes[]" data-area-id="{{$z->city_id}}" value="{{$z->city_id}}" class="user_zipcodes"><span id="zipcode_{{$z->city_id}}" class="inline-flex rounded-md shadow-sm"><button type="button" class="inline-flex items-center mr-2 mb-2 pl-3 pr-2 py-2 border border-transparent text-sm leading-4 font-medium rounded-sm text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 transition ease-in-out duration-150">{{$z->city}}, {{strtoupper($z->state_code)}}<span data-area-id="{{$z->city_id}}" class="block ml-2 px-1 text-white opacity-50 hover:opacity-100 close">×</span></button></span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                        
                    <div class="border-t border-gray-200 mt-4  pt-4 hidden">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Select Your Timezone
                            </h3>
                            <p class="mt-1 text-sm leading-5 text-gray-500">
                                Set timezone for content scheduling.
                            </p>
                        </div>
                        <div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="first_name" class="block text-sm font-medium leading-5 text-gray-700">
                                    Timezone
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <select id="timezone" name="timezone" class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                        <option value="">Select timezone</option>
                                        @foreach (App\Http\Helpers\HelperForms::getTimezonesList() as $key => $tz)
                                            @if ( isset($user_preferences) )
                                            <option value="{{$key}}" {{ ($user_preferences->timezone == $key) ? 'selected="selected"' : '' }}>{{$tz['name']}}</option>
                                            @else
                                            <option value="{{$key}}" {{ (old('timezone') == $key) ? 'selected="selected"' : '' ?? '' }}>{{$tz['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- End Zipcodes --}}
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
<style>
		.delete{
			background-color: #fd1200;
			border: none;
			color: white;
			padding: 5px 15px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 14px;
			margin: 4px 2px;
			cursor: pointer;

		}
	</style>
	<script>
		function remove_Avatar() {
			if (confirm("Are you sure you want to remove profile photo?")) {
				jQuery('#avatar').attr('src','');
				jQuery('#avatarfile').val('');
			}
		}
		function remove_brokerage_Avatar() {
			if (confirm("Are you sure you want to remove brokerage photo?")) {
				jQuery('#brokerage_avatar').attr('src','');
				jQuery('#brokerage_avatarfile').val('');
			}	
		}
	</script>

@endsection
