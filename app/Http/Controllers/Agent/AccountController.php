<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Jobs\CreateAgentCustomHeaderPhotos;

use Validator;

use App\Jobs\CreateAgentCustomPhotos;
use App\Jobs\SendAgentToHousesForSale;
use App\User;

use Carbon\Carbon;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    // Profile
    public function profile(Request $request) {
        $data = [];

        $user = Auth::user();
        $data['user'] = $user;
        return view('agent.account.profile')->with($data);
    }

    public function saveProfile(Request $request)
    {
        $user = Auth::user();
        if ($request->input('profile_user') != $user->uuid && $user->admin) {
            $user = User::where('uuid', $request->input('profile_user'))->first();
        }


        $rules = [
			'first_name' => 'required',
			'last_name' => 'required',
			'phone' => 'required',
			'city' => 'required',
			'state' => 'required',
		];


        if ($this->isFormValidated($request, $rules)) {

			

			$user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->name = $request->input('first_name').' '.$request->input('last_name');
            $user->phone = $request->input('phone');
            $user->office_contact = $request->input('office_contact');
			$user->email = $request->input('email');
			$user->city = $request->input('city');
			$user->state = $request->input('state');
			$user->zipcode = $request->input('zipcode');
			$user->street = $request->input('address');
			$user->suite = $request->input('suite');

			if(!empty($request->input('facebook'))) {$user->facebook = $request->input('facebook');}
            if(!empty($request->input('twitter'))) {$user->twitter = $request->input('twitter');}
            if(!empty($request->input('linkedin'))) {$user->linkedin = $request->input('linkedin');}
            if(!empty($request->input('website'))) {$user->website = $request->input('website');}
            
            $user->pro_designation = $request->input('pro_designation');
            $user->about = $request->input('about');

			if ($request->file('avatar')) {
				if ( $user->avatar ) {
					$user->deleteFeaturedImage();
				}
				$user->uploadFeaturedImage($request->file('avatar'), $request->input('first_name') . ' ' . $request->input('last_name'));
				$user->save();
			} else {
				$user->save();
			}			

			Session::flash('status', 'success');
			Session::flash('message', 'Your profile was successfully updated!');
		}

        Session::flash('message_type', $request->input('profile_form'));
        return redirect()->back();
    }

    

    // Settings
    public function settings(Request $request) {
        $data = [];

        $user = Auth::user();
        $data['user'] = $user;
        $data['agent'] = $user->agent;

        return view('agent.account.settings')->with($data);
    }

    public function saveSettings(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'current_email'                        => 'required|unique:users,email,' . $user->id . '|confirmed',
            'new_password'                     => 'required|min:6|confirmed|string',
        ];

        if ($this->isFormValidated($request, $rules)) {

            $user->email = $request->input('current_email');
            $user->password = Hash::make($request->input('new_password'));

            $user->save();

            Session::flash('status', 'success');
            Session::flash('message', 'Your profile was successfully updated!');
        }
        return redirect()->back();
    }

   

    public function phoneNiceFormat($phone)
    {
        $phone_form = '';

        if (strlen($phone) == 10) {
            $phone_form = '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6, 4);
        }

        if ($phone_form)
            return $phone_form;
        else
            return $phone;
    }
}
