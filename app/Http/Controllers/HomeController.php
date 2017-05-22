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
use Image;

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

        $files = scandir('assets/images/posts');
        foreach($files as $file) {

            $this_file = 'assets/images/posts/'.$file.'/prm/image/';
            if ( file_exists($this_file) ) {
                $files2 = scandir($this_file);
                foreach($files2  as $img_name) {
                    if ( $img_name!='.'&&$img_name!='..') {
                        
                        // $img_name = 'd0jKR_1486958664.jpeg';
                    
                        // open an image file
                        $img = Image::make($this_file.$img_name);

                        $size = $img->filesize();
                        $width = $img->width();

                        if ($width>750 || $size > 250000) {
                            // insert watermark at bottom-right corner with 10px offset
                            $img->insert('watermark.png', 'bottom-right', 10, 10);
                            // resize the image to a width of 300 and constrain aspect ratio (auto height)
                            $img->resize(750, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                            // finally we save the image as a new file
                            $img->save($this_file.$img_name);
                        }
                    }



                }                       
            }
         
        }

        
        
        // $img_name = 'watermark.png';
        
        // // open an image file
        // $img = Image::make($img_name);

        // $size = $img->filesize();
        // $width = $img->width();

        // // insert watermark at bottom-right corner with 10px offset
        // $img->insert('watermark.png', 'bottom-right', 10, 10);
        // // resize the image to a width of 300 and constrain aspect ratio (auto height)
        // $img->resize(300, null, function ($constraint) {
        //     $constraint->aspectRatio();
        // });
        // // finally we save the image as a new file
        // $img->save($img_name);






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
