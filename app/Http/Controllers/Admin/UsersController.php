<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;

class UsersController extends Controller
{
    public function index()
    {
        $data = [];

        $data['items'] = User::orderBy('id', 'DESC')->paginate(20);

        return view('admin.users.index')->with($data);
    }


    public function view($uuid) {
        $data = [];

        $user = User::where('uuid', $uuid)->firstOrFail();

        $data['user'] = $user;

        return view('admin.users.view')->with($data);
    }


    public function viewCalendar($uuid)
    {
        $data = [];

        $user = User::where('uuid', $uuid)->firstOrFail();

        $data['user'] = $user;

        return view('admin.users.calendar')->with($data);
    }

    // Just for admin to acces users profile
    public function viewProfile($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $data = [
            'user' => $user,
            'agent' => $user->agent,
        ];

        return view('agent.account.profile')->with($data);
    }

   
}
