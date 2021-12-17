@extends('layouts.app')

@section('content')


<div class="max-w-7xl mx-left px-4 sm:px-6 md:px-8">
    <form action="{{route('agent.profile.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="profile_form" value="form_agent_info">
        <input type="hidden" name="profile_user" value="{{ $user->uuid }}">
		
		 
            <div class="px-4 py-5 sm:p-3">
				@if ( Session::get('message_type') == 'profile_form' )
                @include ('shared.components.alert')
                @endif
               
            </div>
        
        <div class="bg-white overflow-hidden mb-4">
				@include('agent.title', ['title' => 'Photo Profile'])
			<div class="mt-6 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-12">
				<div class="sm:col-span-6">
					<div class="sm:col-span-12 ml-5">
						<div class="flex items-center">
							<span class="h-36 w-36 overflow-hidden bg-gray-100 relative">
								@if ( Auth::user()->avatar ) 
									<img id="avatar" src="{{URL::to('/')}}/storage/{{Auth::user()->getThumbnailPath('180x180')}}" class="w-38 h-auto -ml-4 -mt-4 max-w-none absolute top-0 right-0 bottom-0 left-0">
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
       
       
			
        <div class="bg-white overflow-hidden mt-2 mb-4">
            @include('agent.title', ['title' => 'Contact Info'])
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
								<input id="pro_designation" name="pro_designation" value="{{$user->pro_designation ?? old('pro_designation')}}" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
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
            @include('agent.title', ['title' => 'About'])
            <div class="mt-2 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
				<div class="sm:col-span-6">
					<div class="mt-1 rounded-md shadow-sm">
						<textarea name="about" id="about" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" cols="30" rows="10" placeholder="Enter details about you: background,interests etc">{{$user->about ?? old('about')}}</textarea>
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
