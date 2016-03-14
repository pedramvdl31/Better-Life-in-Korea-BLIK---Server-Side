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

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Page;
use App\WebsiteBrand;
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

      // $after_array =array();

      // $names['name'] = array();


      // $file = File::get('assets/all_cities.json');
      // $new_file = json_decode($file,true);
      // foreach ($new_file as $k => $v) {
      //   if ($k == "Republic of Korea") {
      //     foreach ($v as $vk => $vv) {
      //       $names['name']=$vv;
      //       $names['realName']='-';
      //       $after_array['Korea'][$vk] = $names;
      //     }
      //   }
      // }
      // Job::dump(json_encode($after_array));

        if (Auth::check()) {
            $cats = Job::cat_select();
            $wishlist = Wishlist::PrepareForHome(Wishlist::where('status',1)->where('user_id',Auth::id())->get());
        }
        $ads = Ad::PrepareAdsForHome(Ad::where('status',1)->paginate(10));

        
        $layout_title = 'layouts.customize_layout';
            return view('home.homepage')
            ->with('cats',isset($cats)?$cats:null)
            ->with('wishlist',isset($wishlist)?$wishlist:null)
            ->with('ads',$ads)
            ->with('layout',$layout_title);
    }

    public function getUpdateMessages()
    {
        header("Content-Type: text/event-stream");

        while (1) {
          echo 'data: {"time": ""}\n\n';
          
          ob_end_flush();
          flush();
          sleep(1);
        }
    }

    public function writemessage()
    {
      return view('writemessage');
    }
    public function sendMessage(){
      $redis = Redis::connection();
      $redis->publish('message', Request::input('message'));
      return redirect('writemessage');
    }


}
