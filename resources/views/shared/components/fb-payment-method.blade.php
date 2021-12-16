@if ( Auth::user()->getFacebookActiveAdAccountId() && !Auth::user()->hasFacebookPaymentMethod() )
<div class="space-y-1">
    <div class="rounded-md bg-blue-50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
            <svg class="w-4 h-4 inline text-blue-500 mb-1 mx-1" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
            </div>
            <div class="ml-3">


                <p class="text-sm leading-5 text-blue-800">
                    You don't have an active payment method with Facebook. You need to add one before creating Facebook Ads, by clicking on the button below.
                </p>
                <div class="py-4">
                    <button type="button" onclick="openFacebookPaymentDialog()" style="background-color: #4267b2; border-color: ##4267b2;" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white focus:outline-nonetransition duration-150 ease-in-out">
                        Add Payment Method in Facebook
                    </button>
                    @push('scripts')
                        <script>
                            window.fbAsyncInit = function() {
                                FB.init({
                                appId            : '{{config("services.facebook.client_id")}}',
                                autoLogAppEvents : true,
                                xfbml            : true,
                                version          : 'v11.0'
                                });
                            };

                            (function(d, s, id){
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) {return;}
                                js = d.createElement(s); js.id = id;
                                js.src = "https://connect.facebook.net/en_US/sdk.js";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));
                        </script>
                        <script crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

                        <script>
                            function openFacebookPaymentDialog() {
                                FB.ui({
                                    account_id: '{{Auth::user()->getFacebookActiveAdAccountId()}}',
                                    display: 'popup',
                                    method: 'ads_payment',
                                });
                            }
                        </script>
                    @endpush
                </div>


            </div>
        </div>
    </div>
</div>

@endif
