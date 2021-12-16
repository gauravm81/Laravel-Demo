  <!-- Off-canvas menu for mobile -->
  <div class="md:hidden">
    <div @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-gray-600 opacity-0 pointer-events-none transition-opacity ease-linear duration-300" :class="{'opacity-75 pointer-events-auto': sidebarOpen, 'opacity-0 pointer-events-none': !sidebarOpen}"></div>
    <div class="fixed inset-y-0 left-0 flex flex-col z-40 max-w-xs w-full bg-gray-800 transform ease-in-out duration-300 -translate-x-full" :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
      <div class="absolute top-0 right-0 -mr-14 p-1">
        <button x-show="sidebarOpen" @click="sidebarOpen = false" class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600">
          <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex-shrink-0 flex items-center h-16 bg-gray-900">
            <h1 class="text-cool-gray-700 font-medium text-xl h-16 sm:text-xl">
                <a href="{{ route('agent.dashboard') }}" class="text-white">
                    <img src="{{asset('images/logo-square.svg')}}" class="h-16 w-16 inline mr-2" alt="Boostable.media">
                    <strong>Boostable</strong><span class="font-medium">.media</span>
                </a>
            </h1>
      </div>
      <div class="flex-1 h-0 overflow-y-auto">
        <nav class="px-2 py-4">
		<!--
          @if ( Route::currentRouteName() == 'agent.dashboard')
          <a href="{{route('agent.dashboard')}}" class="group flex items-center px-2 py-2 text-base leading-5 font-medium text-white rounded-md bg-gray-900 focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150">
          @else
          <a href="{{route('agent.dashboard')}}" class="group flex items-center px-2 py-2 text-baseleading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
          @endif
              <svg class="mr-4 h-6 w-6 text-gray-300 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6"/>
              </svg>
              Dashboard
          </a>
		-->
			@if($user->profileProgress->onboard_complete == 0)
				<a disabled="" class="mt-1 disabled_link group flex items-center px-2 py-2 text-base  leading-5 font-medium text-white rounded-md bg-gray-900 focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150">
					<svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Content Calendar
                </a>
			@else
              @if ( Route::currentRouteName() == 'agent.calendar')
                <a href="{{route('agent.calendar')}}" class="mt-1 group flex items-center px-2 py-2 text-base  leading-5 font-medium text-white rounded-md bg-gray-900 focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150">
                @else
                <a href="{{route('agent.calendar')}}" class="mt-1 group flex items-center px-2 py-2 text-base  leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                @endif
                    <svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Content Calendar
                </a>
             @endif   
			 @if($user->profileProgress->onboard_complete == 0)
				<a disabled="" class="mt-1 disabled_link group flex items-center px-2 py-2 text-base  leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
					<svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    Content Management
                </a>
			 @else
                @if ( Request::is('content/*') )
                <a href="#navMobile_Content" class="left-nav-dropdown-toggle relative left-nav-dropdown-opened mt-1 group flex items-center px-2 py-2 text-base  leading-5 font-medium text-white rounded-md bg-gray-900 focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150">
                @else
                <a href="#navMobile_Content" class="left-nav-dropdown-toggle relative mt-1 group flex items-center px-2 py-2 text-base  leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                @endif
                    <svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                    Content Management

                    <svg class="float-right ml-2 h-5 w-5 absolute right-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
                @if ( Request::is('content/*') )
                <ul id="navMobile_Content" class="left-nav-dropdown pl-12">
                @else
                <ul id="navMobile_Content" class="left-nav-dropdown pl-12" style="display: none">
                @endif
                    <li class="py-1"><a href="{{route('agent.content.social-media-networks')}}" class="text-sm {{Route::currentRouteName() == 'agent.content.social-media-networks' ? 'text-white' : 'text-gray-400'}} hover:text-white">Social Media Networks</a></li>
                    <li class="py-1"><a href="{{route('agent.content.manage')}}" class="text-sm {{Route::currentRouteName() == 'agent.content.manage' ? 'text-white' : 'text-gray-400'}} hover:text-white">Content Categories</a></li>
                    <li class="py-1"><a href="{{route('agent.content.settings')}}" class="text-sm {{Route::currentRouteName() == 'agent.content.settings' ? 'text-white' : 'text-gray-400'}} hover:text-white">Content Settings</a></li>
                    <li class="py-1"><a href="{{route('agent.listings.index')}}" class="text-sm {{Route::currentRouteName() == 'agent.listings.index' ? 'text-white' : 'text-gray-400'}} hover:text-white">Listings</a></li>
                    <li class="py-1"><a href="{{route('agent.content.listings')}}" class="text-sm {{Route::currentRouteName() == 'agent.content.listings' ? 'text-white' : 'text-gray-400'}} hover:text-white">Listings Settings</a></li>
   
                </ul>
              @endif  
              @if($user->profileProgress->onboard_complete == 0)
				<a disabled="" class="mt-1 disabled_link group flex items-center px-2 py-2 text-base  leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
					<svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Leads
                </a>
			 @else  
                @if ( Route::currentRouteName() == 'agent.leads.index' || Request::is('leads/*') )
                <a href="{{route('agent.leads.index')}}" class="mt-1 group flex items-center px-2 py-2 text-base  leading-5 font-medium text-white rounded-md bg-gray-900 focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150">
                @else
                <a href="{{route('agent.leads.index')}}" class="mt-1 group flex items-center px-2 py-2 text-base  leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                @endif
                    <svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Leads
                </a>
			@endif 	
            @if($user->profileProgress->onboard_complete == 0)
				<a disabled="" class="mt-1 disabled_link group flex items-center px-2 py-2 text-base  leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
					<svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Reports
                </a>
			 @else      
                @if ( Route::currentRouteName() == 'agent.reports.index')
                <a href="{{route('agent.reports.index')}}" class="mt-1 group flex items-center px-2 py-2 text-base  leading-5 font-medium text-white rounded-md bg-gray-900 focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150">
                @else
                <a href="{{route('agent.reports.index')}}" class="mt-1 group flex items-center px-2 py-2 text-base  leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                @endif
                    <svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Reports
                </a>
			@endif 	
            @if($user->profileProgress->onboard_complete == 0)
				<a disabled="" class="mt-1 disabled_link group flex items-center px-2 py-2 text-base  leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
					<svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor" fill="none" viewBox="0 0 22 22">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"/>
                    </svg>
                    Account Settings
                </a>
			 @else  
                
                @if ( Request::is('account/*') )
                <a href="#navMobile_AccountSettings" class="left-nav-dropdown-toggle relative left-nav-dropdown-opened mt-1 group flex items-center px-2 py-2 text-base  leading-5 font-medium text-white rounded-md bg-gray-900 focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150">
                @else
                <a href="#navMobile_AccountSettings" class="left-nav-dropdown-toggle relative mt-1 group flex items-center px-2 py-2 text-base  leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                @endif
                    <svg class="mr-4 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor" fill="none" viewBox="0 0 22 22">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"/>
                    </svg>
                    Account Settings

                    <svg class="float-right ml-2 h-5 w-5 absolute right-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
                @if ( Request::is('account/*') )
                <ul id="navMobile_AccountSettings" class="left-nav-dropdown pl-12">
                @else
                <ul id="navMobile_AccountSettings" class="left-nav-dropdown pl-12" style="display: none">
                @endif
                    <li class="py-1"><a href="{{route('agent.profile')}}" class="text-sm {{Route::currentRouteName() == 'agent.profile' ? 'text-white' : 'text-gray-400'}} hover:text-white">My Info</a></li>
                    <li class="py-1"><a href="{{route('agent.settings')}}" class="text-sm {{Route::currentRouteName() == 'agent.settings' ? 'text-white' : 'text-gray-400'}} hover:text-white">Settings</a></li>
                    <li class="py-1"><a href="{{route('agent.notifications')}}" class="text-sm {{Route::currentRouteName() == 'agent.notifications' ? 'text-white' : 'text-gray-400'}} hover:text-white">Notifications</a></li>
                </ul>
			@endif

        </nav>
      </div>
    </div>
  </div>
