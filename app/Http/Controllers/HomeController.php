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
use Redis;
use File;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Page;
use App\Ad;
use App\Wishlist;

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



        // for ($i=0; $i < 30 ; $i++) { 
        //     $adads = new Ad();
        //     $adads->cat_id = 2;
        //     $adads->city = 3;
        //     $adads->title = 'test';
        //     $adads->description = 'test';
        //     $adads->status = 1;
        //     $adads->user_id = 1;
        //     $adads->save();
        // }

        $cats='';
        $provs='';
        $wishlist='';
        if (Auth::check()) {
            $cats = Job::cat_select();
            $provs = Job::prov_select();
            $wishlist = Wishlist::PrepareForHome(Wishlist::where('status',1)->where('user_id',Auth::id())->get());
        }

        $all_categories = Ad::PrepareCategoriesHtml();
        $layout_title = 'layouts.customize_layout';


        return view('home.homepage')
        ->with('cats',$cats)
        ->with('provs',$provs)
        ->with('wishlist',$wishlist)
        ->with('all_categories',$all_categories)
        ->with('popup',0)
        ->with('cdt',date('Y-m-d H:i:s'))
        ->with('layout',$layout_title);
    }

      public function getHomePageM()
    {   
      return view('home.m_homepage')
        ->with('layout','layouts.default');

    }

    public function getPopUpPost($id=null)
    { 
        if (Auth::check()) {
            $cats = Job::cat_select();
            $wishlist = Wishlist::PrepareForHome(Wishlist::where('status',1)->where('user_id',Auth::id())->get());
        }
        $ads = Ad::PrepareAdsForHome(Ad::where('status',1)->orderBy('id', 'desc')->take(8)
               ->get());
        $all_categories = Ad::PrepareCategoriesHtml();
        $layout_title = 'layouts.customize_layout';

        return view('home.homepage')
        ->with('cats',isset($cats)?$cats:null)
        ->with('wishlist',isset($wishlist)?$wishlist:null)
        ->with('ads',$ads)
        ->with('popup',$id)
        ->with('all_categories',$all_categories)
        ->with('cdt',date('Y-m-d H:i:s'))
        ->with('layout',$layout_title);
    }
    

    public function postRtrnSrvrTime()
    {
      return Response::json(array(
          'rst' => date('Y-m-d H:i:s')
          ));
    }


}
