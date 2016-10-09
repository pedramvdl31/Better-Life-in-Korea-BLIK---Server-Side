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
      // for ($i=2;$i<=11;$i++) { 
      //   DB::table('ads')->insert([
      //     [
      //         'user_id' => '1',
      //         'cat_id' => '1',
      //         'subcat_id' => '1',
      //         'title' => 'Lorem ipsum dolor',
      //         'city' => '4',
      //         'description' => '"Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, "',
      //         'status' => 1
      //     ]
      //  ]);
      // }

      
      // $after_array =array();

      // $names['name'] = array();

      // $html = '';
      // $file = File::get('assets/all_cities.json');
      // $new_file = json_decode($file,true);
      // foreach ($new_file as $k => $v) {
      //   if ($k == "Republic of Korea") {
      //     foreach ($v as $vk => $vv) {
      //       $nvv = str_replace("'","",$vv);
      //       $html .= "case '".$vk."':<br>";
      //       $html .= "cttxt = '".$nvv."';<br>";
      //       $html .= "break;<br>";
      //     }
      //   }
      // }
      // echo $html;
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
