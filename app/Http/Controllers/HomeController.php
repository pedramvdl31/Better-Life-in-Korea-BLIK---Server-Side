<?php

namespace App\Http\Controllers;


use Input;
use Validator;
use Redirect;
use Hash;
use Request;
use Route;
use Response;
use Auth;
use URL;
use Session;
use Laracasts\Flash\Flash;
use View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Page;
use App\WebsiteBrand;

class HomeController extends Controller
{
    public function __construct() {
        $this->layout = "layouts.index-layouts.index";
        //CHECK IF THE HOMEPAGE IS SET
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

        public function getHomePage()
    {   
        if (Auth::check()) {
            $cats = Job::cat_select();
            $subcats = Job::subcat_select();
        }
        
        $layout_title = 'layouts.customize_layout';
            return view('home.homepage')
            ->with('cats',isset($cats)?$cats:null)
            ->with('subcats',isset($subcats)?$subcats:null)
            ->with('layout',$layout_title);
    }


}
