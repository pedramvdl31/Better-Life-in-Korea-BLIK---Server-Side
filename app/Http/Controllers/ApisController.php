<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Validator;
use Redirect;
use Response;
use Auth;
use View;
use App\Job;
use App\User;
use App\Admin;

class ApisController extends Controller
{
    public function postInit() {
            return Response::json(array(
            'status' => 200
            ));

    }
    public function postLogin() {
            $status = 400;
            $_form = null;
            $tkn = null;
            $email = Input::get('email');
            $password = Input::get('password');
            if (Auth::attempt(array('email'=>$email, 'password'=>$password))) {
                $tkn = Job::generateRandomString(15);
                $cu = User::where('email',$email)->first();
                $cu->api_token=$tkn;
                $cu->save();
                $status = 200;
            }



            return Response::json(array(
            'status' => $status,
            'tkn' => $tkn
            ));

    }
}
