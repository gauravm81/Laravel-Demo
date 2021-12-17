<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Notification;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Str;
use Validator;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
    }

    public function index(Request $request) {
        $data = [];
        $user = Auth::user();
		$data['notifications'] = Notification::where('user_id',$user->id)->take(5)->get();
        return view('agent.dashboard.index')->with($data);
    }

}
