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

    public function getPostsIndex()
    {   
    	$all_posts = Dashboard::PrepareAllPosts(Ad::where('status',1)->where('user_id',Auth::id())->get());
        return view('dashboard.posts_index')
            ->with('layout',$this->layout)
            ->with('all_posts',$all_posts);
    }

    
}
