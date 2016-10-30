<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Validator;
use Redirect;
use Route;
use Response;
use Auth;
use URL;
use Laracasts\Flash\Flash;
use View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Ad;
use App\Dashboard;

class DashboardsController extends Controller
{
    public function __construct() {
        $this->layout = 'layouts.dashboard';
    }

    public function getIndex()
    {   
        return view('dashboard.index')
            ->with('layout',$this->layout);
    }
    public function getIndexApi($tkn=null)
    {   
        if (isset($tkn)) {
            $this_u = User::where('api_token',$tkn)->first();
            if (isset($this_u)&&!empty($this_u)) {
                Auth::loginUsingId($this_u->id);
                return view('dashboard.index')
                    ->with('layout',$this->layout);
            }
        }
    }

    public function getPostsIndex()
    {   
        $all_posts = Dashboard::PrepareAllPosts(Ad::where('status',1)->where('user_id',Auth::id())->get());
        return view('dashboard.posts_index')
            ->with('layout',$this->layout)
            ->with('all_posts',$all_posts);
    }

    public function getViewProfile()
    {   
        $user = User::find(Auth::id());
        $uiPath = '/assets/images/profile-images/perm/';
        return view('dashboard.profile_index')
            ->with('layout',$this->layout)
            ->with('uiPath',$uiPath)
            ->with('user',isset($user)?$user:null);
    }

    public function getProfileEdit($id=null)
    {   
        $user = User::find(Auth::id());
        return view('dashboard.profile_edit')
            ->with('layout',$this->layout)
            ->with('user',isset($user)?$user:null);
    }

    public function postProfileEdit()
    {   
        $_user = User::find(Auth::id());
        $_user->first_name = Input::get('first_name');
        $_user->last_name = Input::get('last_name');
        $_user->description = Input::get('description');
        if ($_user->save()) {
            Flash::success('Successfully Updated!');
            return Redirect::route('users_dash');
        }
        return Redirect::back();
    }


    
}
