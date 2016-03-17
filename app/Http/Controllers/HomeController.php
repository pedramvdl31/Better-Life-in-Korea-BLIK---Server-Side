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
      // for ($i=1;$i<=11;$i++) { 
      //   DB::table('ads')->insert([
      //     [
      //         'id' => $i,
      //         'user_id' => '1',
      //         'cat_id' => '1',
      //         'subcat_id' => '1',
      //         'title' => 'Lorem ipsum dolor',
      //         'city' => 'seoul',
      //         'description' => '"Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, "',
      //         'file_srcs' => '[{"image":{"name":"fMFws_1458051477.jpeg"}}]',
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
      //       $html .= '<option value="'.$vk.'">'.$vv.'</option>';
      //     }
      //   }
      // }
      // echo $html;

        if (Auth::check()) {
            $cats = Job::cat_select();
            $wishlist = Wishlist::PrepareForHome(Wishlist::where('status',1)->where('user_id',Auth::id())->get());
            $cities = Job::korean_cities();
        }
        $ads = Ad::PrepareAdsForHome(Ad::where('status',1)->orderBy('id', 'desc')->paginate(9));

        
        $layout_title = 'layouts.customize_layout';
            return view('home.homepage')
            ->with('cats',isset($cats)?$cats:null)
            ->with('wishlist',isset($wishlist)?$wishlist:null)
            ->with('ads',$ads)
            ->with('cities',isset($cities)?$cities:null)
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
