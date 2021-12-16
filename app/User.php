<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Arr;

use App\Traits\FeaturedImage;

class User extends Authenticatable
{
    
    use FeaturedImage;

    public $resource_name = 'user';
    public $featured_image_db_name = 'avatar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'first_name', 'last_name', 'name', 'email', 'password', 'phone', 'user_type', 'avatar',
        'facebook_reconnect', 'linkedin_reconnect', 'instagram_reconnect', 'next_posts_batch'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Agent
    public function agent()
    {
        return $this->hasOne('App\Models\Agent', 'user_id', 'id');
    }

    // Listings

    // Posts
    public function posts() {
        return $this->hasMany('App\Models\ContentPost');
    }

    // Leads
    public function leads()
    {
        return $this->hasMany('App\Models\Lead');
    }

    // Localization
    public function zipcodes() {
        return $this->hasMany('App\Models\UserZipcode');
    }
    public function zipcodesCities()
    {
        $zipcodes = $this->hasMany('App\Models\UserZipcode')->pluck('zipcode')->toArray();

        $cities = \App\Models\Zipcode::select('city', 'state_code')->whereIn('zipcode', $zipcodes)->groupBy('city', 'state_code')->get();
        return $cities;
    }
    public function zipcodesList() {
        $zipcodes = $this->hasMany('App\Models\UserZipcode')->get();
        $zipcodes_array = [];

        foreach ( $zipcodes as $z ) {
            array_push($zipcodes_array, $z->zipcode);
        }
        return implode(', ', $zipcodes_array);
    }



    // Profile progress
    public function profileProgress()
    {
        return $this->hasOne('App\Models\UserProfileProgress', 'user_id', 'id');
    }

    public function calculateProfileProgress() {
        $fields = [
            'facebook_connection', 'zipcodes', 'signature', 'mls_connection', 'listings_filters', 'profile_filled', 'show_progress'
        ];

        $progress = $this->profileProgress()->select($fields)->first();

        array_pop($fields);

        $filled = 0;
        $not_filled = count($fields);


        if ( $progress ) {
            $progress->toArray();

            foreach ( $fields as $f ) {
                if ( $progress[$f] == 1 )
                    $filled++;
            }
        } else {
            $progress = new UserProfileProgress;
            $progress->user_id = $this->id;
            $progress->save();
        }

        $return = [
            'filled' => $filled,
            'not_filled' => $not_filled,
            'percent' => ( $filled > 0 ) ? number_format( ($filled/$not_filled) * 100 ) : 0,
            'data' => $progress
        ];
        return $return;
    }

    // Free trial
    public function freeTrial() {
        return $this->hasOne('App\Models\UserFreeTrial');
    }

    public function getRemainingFreeTrialDays() {
        $days = 0;
        $free_trial = $this->freeTrial;

        if ( $free_trial ) {
            $start = Carbon::parse($free_trial->start);
            $end = Carbon::parse($free_trial->end);

            $days = $end->diffInDays(Carbon::now());
            if ( (strtotime($end->toDateTimeString()) - strtotime(Carbon::now())) > 0 ) {
                $days = ($days < 1) ? 0 : $days + 1;
                $days = ($days > 14) ? 14 : $days;
            } else
                $days = 0;
        }

        return $days;
    }



    // Preferences & Settings
    public function preferences() {
        return $this->hasOne('App\Models\UserPreference', 'user_id', 'id');
    }


    public function preference($p)
    {
        if ($this->preferences) {
            $preference = $this->preferences()->first()->toArray();
            return $preference[$p];
        } else {
            return null;
        }
    }

    public function contentCategories() {
        $categories = null;

        if ($this->preferences )
            $categories = json_decode($this->preferences->categories, true);

        return $categories;
    }


    public function getURLCookie() {
        return md5($this->uuid);
    }

    public function getAvatar() {
        if ( !empty($this->avatar) )
            return '/'.config('homesforsale.storage.user_avatar.front').$this->avatar;
        else
            return NULL;
    }




    public function isAdmin()
    {
        return $this->admin; // this looks for an admin column in your users table
    }




    public function phoneNiceFormat()
    {
        $phone = '';

        if (strlen($this->phone) == 10) {
            $phone = '(' . substr($this->phone, 0, 3) . ') ' . substr($this->phone, 3, 3) . '-' . substr($this->phone, 6, 4);
        }

        if ($phone)
            return $phone;
        else
            return $this->phone;
    }


    // Subscriptions
    public function subscription() {
        return $this->hasMany('App\Models\Subscription')->orderBy('created_at', 'desc')->first();
    }

    public function plan() {
        $subscription = $this->subscription();

        $plan_name = explode('_', $subscription->name);

        if (
            !empty(config('boostable.products.' . $plan_name[0] . '.plans.' . $plan_name[1] . '.stripe_id')) &&
            config('boostable.products.' . $plan_name[0] . '.plans.' . $plan_name[1] . '.stripe_id') == $subscription->stripe_plan
        ) {
            return ucfirst($plan_name[0]).' '. ucfirst($plan_name[1]);
        }
    }



    // Social Media connection
    public function socialMediaConnection()
    {
        return $this->hasMany('App\Models\SocialMediaConnection');
    }
    
    public function facebookMediaConnection()
    {
        return $this->hasMany('App\Models\FacebookMediaConnection');
    }
    
    public function hasProfileProgress($platform) {
		$connection = $this->profileProgress()->first();
		return $connection;
	}
	
	public function hasSocialMediaConnectionFbStep($platform,$onlyActive = false) {
		$connection = $this->socialMediaConnection()->where('platform', $platform)
					->Where(function ($query) {
						$query->where('fb_step', '<>', 'completed')
							  ->Where('fb_step', '<>', null);
					})
                    ->first();
  
		if ( $connection )
            return true;
        else
            return false;
	}

    public function hasSocialMediaConnection($platform, $onlyActive = false) {
        if ($onlyActive) {
            $connection = $this->socialMediaConnection()->where('platform', $platform)->where('fb_step', 'completed')->first();
        } else {
            $connection =  $this->socialMediaConnection()->where('platform', $platform)->first();
        }    

        if ( $connection )
            return true;
        else
            return false;
    }

    public function hasFacebookConnection($onlyActive = false) {
        return $this->hasSocialMediaConnection('facebook', $onlyActive);
    }
    
    public function facebooksocialConnection() {
        //return $this->socialMediaConnection()->where('platform', 'facebook')->where('status', 'active')->first();
        $social = $this->facebookMediaConnection()->where('platform', 'facebook')->first();
		return $social;
    }

    public function facebookConnection() {
        //return $this->socialMediaConnection()->where('platform', 'facebook')->where('status', 'active')->first();
        $social = $this->socialMediaConnection()->where('platform', 'facebook')->first();
		return $social;
    }

    public function getFacebookActiveConnectionWithCompletedStep() {
        $facebookConnection = $this->socialMediaConnection()
            ->where('platform', 'facebook')
            ->where('status', 'active')
            ->where('fb_step', 'completed')
            ->first();

        if (empty($facebookConnection)) {
            $facebookConnection = $this->socialMediaConnection()
                ->where('platform', 'facebook')
                ->where('status', 'active')
                ->whereNull('fb_step')
                ->first();
        }

        return $facebookConnection;
    }

    public function facebookConnectionWithToken() {
       return $this->socialMediaConnection()
                            ->where('platform', 'facebook')
                            ->whereNotNull('platform_user_token')
                            ->orderBy('status', 'asc')
                            ->first();
    }


    public function hasInstagramConnection($onlyActive = false)
    {
        return $this->hasSocialMediaConnection('instagram', $onlyActive);
    }

    public function instagramConnection()
    {
        return $this->socialMediaConnection()->where('platform', 'facebook')->where('status', 'active')->first();
    }


    public function hasLinkedinConnection($onlyActive = false)
    {
        return $this->hasSocialMediaConnection('linkedin', $onlyActive);
    }

    public function linkedinConnection()
    {
        return $this->socialMediaConnection()->where('platform', 'facebook')->where('status', 'active')->first();
    }


    public function hasTwitterConnection($onlyActive = false)
    {
        return $this->hasSocialMediaConnection('twitter', $onlyActive);
    }

    public function twitterConnection()
    {
        return $this->socialMediaConnection()->where('platform', 'facebook')->where('status', 'active')->first();
    }


    // FACEBOOK Business Stuff
    public function facebookBusinesses() {
        return $this->hasMany('App\Models\FacebookBusiness');
    }
    public function facebookAdAccounts()  {
        return $this->hasMany('App\Models\FacebookAdAccount');
    }

    public function facebookBusinessManagers() {
        return $this->hasMany('App\Models\FacebookBusinessManager');
    }


    // Business, Ad Account, Can post Ads?
    public function getFacebookActiveAdAccount()
    {
        $account = null;

        $connection = $this->facebookConnection();

        if ($connection) :
            $page = \App\Models\FacebookPage::where('user_id', $this->id)->where('facebook_page_id', $connection->page_id)->first();

            if ( $page ) :
                if ($page && $page->facebook_business_id > 0) {
                    $business = \App\Models\FacebookBusiness::where('user_id', $this->id)->where('facebook_business_id', $page->facebook_business_id)->first();

                    if ($business) {
                        $account = $this->facebookAdAccounts()->where('user_id', $this->id)->where('facebook_business_id', $business->facebook_business_id)->first();
                    }
                }

                // Get personal ad account
                if (!$account)
                    $account = $this->facebookAdAccounts()->where('user_id', $this->id)->whereNull('facebook_business_id')->first();
            endif;
         endif;

        return $account;
    }

    // Return string
    public function getFacebookActiveAdAccountId() {
        $account_id = null;

        $account = $this->getFacebookActiveAdAccount();
        if ( $account )
            $account_id = $account->facebook_id;

        return $account_id;
    }

    public function getFacebookActiveBusiness() {
        $business = false;

        $connection = $this->facebookConnection();

        if ($connection) :
            $page = \App\Models\FacebookPage::where('user_id', $this->id)->where('facebook_page_id', $connection->page_id)->first();
            if ( $page && $page->facebook_business_id > 0 ) {
                $business = \App\Models\FacebookBusiness::where('user_id', $this->id)->where('facebook_business_id', $page->facebook_business_id)->first();
            }
        endif;

        return $business;
    }

    public function hasFacebookPaymentMethod() {
        $account = $this->getFacebookActiveAdAccount();

        if ( $account ) {
            if ( !empty($account->funding_source) )
                return true;
            else
                return false;
        }
    }

    public function canCreateFacebookAds() {
        $response = false;

        // Ideal scenario
        // User has Business, Business Page, Business Ad Account
        $business = $this->getFacebookActiveBusiness();
        $adaccount = $this->getFacebookActiveAdAccountId();
        $page = null;

        $connection = $this->facebookConnection();
        if ( $connection )
            $page = \App\Models\SocialMediaConnection::where('user_id', $this->id)->where('page_id', $connection->page_id)->first();

        if ( $adaccount && $page )
            $response = true;

        // Secondary scenario
        // User has Business, Business Page, but only personal Ad Account

        return $response;
    }


    // Check subscription type
    public function hasLeadGenSubscription() {
        return false;
    }
}
