<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function returnFormWithErrors($validator)
    {

        Session::flash('status', 'error');
        Session::flash('message', 'Please review the errors and try again!');

        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }


    public function isFormValidated($request, $rules, $messages = [] )
    {

        $validator = Validator::make($request->all(), $rules, $messages );

        if ($validator->fails())
            $this->returnFormWithErrors($validator);
        else
            return true;
    }
}
