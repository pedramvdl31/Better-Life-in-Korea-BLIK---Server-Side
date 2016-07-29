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
use App\Ad;
use App\Wishlist;

class AdsController extends Controller
{
    public function postQkpst()
    {
        if(Request::ajax()){
            $status = 200;
            $_form = null;
            parse_str(Input::get('_form'), $_form);

            $cat = $_form['cat'];
            $subcat = $_form['subcat'];
            $title = $_form['title'];
            $city = $_form['city'];
            $_long = isset($_form['long'])?$_form['long']:null;
            $_lat = isset($_form['lat'])?$_form['lat']:null;
            $description = $_form['description'];
            $posted_files = isset($_form['posted_files'])?$_form['posted_files']:NULL;

            if (empty($cat) || empty($subcat) || empty($title) || empty($description)) {
                return Response::json(array(
                    'status' => 400
                    ));
            }
            $ThisUserId = Auth::user()->id;
            //ELSE
            $ads = new Ad();
            $ads->user_id = $ThisUserId;
            $ads->cat_id = $cat;
            $ads->subcat_id = $subcat;
            $ads->city = $city;
            $ads->long = $_long;
            $ads->lat = $_lat;
            $ads->title = $title;
            $ads->description = json_encode($description);
            $ads->status = 1;
            $ads->file_srcs = json_encode($posted_files);
            if ($ads->save()) {
                if (isset($posted_files) && !empty($posted_files)) {
              
                    foreach ($posted_files as $pk => $pv) {
                        foreach ($pv as $pvkey => $pvval) {
                            if ($pvkey == 'image' || $pvkey == 'video') {
                                $tmp_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."posts".DIRECTORY_SEPARATOR.$ThisUserId.DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR.$pvkey.DIRECTORY_SEPARATOR;
                                $new_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."posts".DIRECTORY_SEPARATOR.$ThisUserId.DIRECTORY_SEPARATOR."prm".DIRECTORY_SEPARATOR.$pvkey.DIRECTORY_SEPARATOR;
                                if (!file_exists($tmp_path)) {
                                    mkdir($tmp_path, 0777, true);
                                }               
                                if (!file_exists($new_path)) {
                                    mkdir($new_path, 0777, true);
                                } 
                                $oldpath = public_path($tmp_path.$pvval['name']);
                                $newpath = public_path($new_path.$pvval['name']);
                                if (file_exists($tmp_path.$pvval['name'])) {
                                    rename($oldpath, $newpath);
                                }  
                            }
                        }
                    }

                    $p_name = array('image','video');
                    foreach ($p_name as $pn => $pnv) {
                        $t_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."posts".DIRECTORY_SEPARATOR.$ThisUserId.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.$pnv.DIRECTORY_SEPARATOR;
                        $files = glob($t_path.'*'); // get all file names
                        foreach($files as $file){ // iterate files
                          if(is_file($file))
                            unlink($file); // delete file
                        }
                    }


                }
            }


            return Response::json(array(
                'status' => $status
                ));
        }
    }


    public function postAdsImageTmp()
    {
        if(Request::ajax()){

            $status = 400;
            $files = $_FILES;
            $tempPath = $files['file']['tmp_name']; 
            $image_name = $files['file']['name'];

            $image_types = $files['file']['type'];
            $type_array = explode('/', $image_types);
            $type = $type_array[1];
            $base_type = $type_array[0];

            
            if ($base_type == "image") {
                $imagePath = public_path('assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.Auth::user()->id.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'image');
            } elseif ($base_type == "video") {
                $imagePath = public_path('assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.Auth::user()->id.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.'video');
            }

            if( ! \File::isDirectory($imagePath) ) {
                \File::makeDirectory($imagePath, 493, true);
            }

            $rand = Job::generateRandomString(5);
            $time = time();
            $final_path = $rand.'_'.$time.'.'.$type;


            if (!is_writable(dirname($imagePath))) {
                $status = 401;
                return Response::json(array(
                    "error" => 'Destination Unwritable'
                    ));
            } else {
                $newpath = $imagePath.DIRECTORY_SEPARATOR.$final_path;
                if (move_uploaded_file($tempPath,$newpath)) {
                    return Response::json(array(
                        'status' => 200,
                        'img_name' => $final_path,
                        'old_name' => $image_name,
                        'base_type' => $base_type
                        ));
                } else {
                    $status = 402;
                }
            }
            return Response::json(array(
                'status' => $status
                ));
        }
    }

    
        public function getGetAds()
    {
        $html = Ad::PrepareAdsForHomeHTML(Ad::where('status',1)->orderBy('id', 'desc')->take(8)
               ->get());
        return Response::json(array(
            'html_data' => $html
            ));
    }

    public function getPostsEdit($id = null)
    {
        if (isset($id)) {
            $ps = Ad::PrepareForEdit(Ad::find($id));
            if (isset($ps)) {
                $cats = Job::cat_select();
                return view('dashboard.posts_edit')
                ->with('layout','layouts.dashboard')
                ->with('cats',$cats)
                ->with('ps',$ps);
            }
        }
        Flash::error('Oops somthing went wrong!');
        return Redirect::route('dash_view_posts');
    }


    public function postPostsEdit()
    {

        $validator = Validator::make(Input::all(), Ad::$rules_edit);
        if ($validator->passes()) {
            //-------------------
            $posted_files = Input::get('posted_files');
            $remove_files = Input::get('remove-files');
            $ThisUserId = Auth::user()->id;
            $ThisAdId = Input::get('ad_id');
            //ELSE
            $ads = Ad::findOrFail($ThisAdId);
            if (isset($ads)) {

                $files_ins = json_decode($ads->file_srcs,true);
                if (isset($remove_files) && !empty($remove_files)) {
                    foreach ($files_ins as $fik => $fiv) {
                        foreach ($fiv as $fivk => $fivv) {
                            foreach ($remove_files as $rfk => $rfv) {
                                if ($rfv['name'] == $fivv['name']) {
                                    unset($files_ins[$fik]);
                                    $prm_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."posts".DIRECTORY_SEPARATOR.$ThisUserId.DIRECTORY_SEPARATOR."prm".DIRECTORY_SEPARATOR.$fivk.DIRECTORY_SEPARATOR;
                                    if (file_exists($prm_path.$fivv['name'])) {
                                        unlink($prm_path.$fivv['name']);
                                    } 
                                }
                            }
                        }
                    }
                }
                if (isset($posted_files) && !empty($posted_files)) {
                    $posted_merge = array_merge($files_ins, $posted_files);
                    foreach ($posted_files as $pk => $pv) {
                        foreach ($pv as $pvkey => $pvval) {
                            if ($pvkey == 'image' || $pvkey == 'video') {
                                $tmp_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."posts".DIRECTORY_SEPARATOR.$ThisUserId.DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR.$pvkey.DIRECTORY_SEPARATOR;
                                $new_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."posts".DIRECTORY_SEPARATOR.$ThisUserId.DIRECTORY_SEPARATOR."prm".DIRECTORY_SEPARATOR.$pvkey.DIRECTORY_SEPARATOR;
                                if (!file_exists($tmp_path)) {
                                    mkdir($tmp_path, 0777, true);
                                }               
                                if (!file_exists($new_path)) {
                                    mkdir($new_path, 0777, true);
                                } 
                                $oldpath = public_path($tmp_path.$pvval['name']);
                                $newpath = public_path($new_path.$pvval['name']);
                                if (file_exists($tmp_path.$pvval['name'])) {
                                    rename($oldpath, $newpath);
                                }  
                            }
                        }
                    }
                    $p_name = array('image','video');
                    foreach ($p_name as $pn => $pnv) {
                        $t_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."posts".DIRECTORY_SEPARATOR.$ThisUserId.DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR.$pnv.DIRECTORY_SEPARATOR;
                        $files = glob($t_path.'*'); // get all file names
                        foreach($files as $file){ // iterate files
                          if(is_file($file))
                            unlink($file); // delete file
                        }
                    }
                }

                $ads->user_id = $ThisUserId;
                $ads->cat_id = Input::get('cat');
                $ads->subcat_id = Input::get('subcat');
                $ads->city = Input::get('city');
                $ads->title = Input::get('title');
                $ads->description = json_encode(Input::get('description'));
                $ads->file_srcs = isset($posted_merge)?json_encode($posted_merge):json_encode($files_ins);
                if ($ads->save()) {
                    Flash::Success('Successfully Edited.');
                    return Redirect::route('dash_view_posts');
                } else {
                    Flash::error('Oops somthing went wrong!');
                    return Redirect::route('dash_view_posts');
                }
            }

        }   else {
        // validation has failed, display error messages    
            return Redirect::back()
            ->with('message', 'The following errors occurred')
            ->with('alert_type','alert-danger')
            ->withErrors($validator)
            ->withInput();          
        }
        
    }


    public function getPostsRemove($id = null)
    {

        if (isset($id)) {
            $ps = Ad::find($id);
            if (isset($ps)) {
                $files_ins = json_decode($ps->file_srcs,true);
                foreach ($files_ins as $fik => $fiv) {
                    foreach ($fiv as $fivk => $fivv) {
                        $prm_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."posts".DIRECTORY_SEPARATOR.Auth::id().DIRECTORY_SEPARATOR."prm".DIRECTORY_SEPARATOR.$fivk.DIRECTORY_SEPARATOR;
                        if (file_exists($prm_path.$fivv['name'])) {
                            unlink($prm_path.$fivv['name']);
                        } 
                    }
                }

                if ($ps->delete()) {
                    Flash::success('Successfully Removed');
                    return Redirect::route('dash_view_posts');
                }
            }
        }
        Flash::error('Oops somthing went wrong!');
        return Redirect::route('dash_view_posts');
    }



    public function postPrepareAds()
    {
        if(Request::ajax()){
            $status = 400;
            $ads = Ad::PrepareForView(Ad::find(Input::get('data_id')));
            $lat_long = Ad::PrepareLatLong(Ad::find(Input::get('data_id')));
            if (isset($ads)) {
                return Response::json(array(
                    'status' => 200,
                    'ad' => $ads,
                    'lat_long' => $lat_long,
                    ));
            }
            return Response::json(array(
                'status' => $status
                ));
        }
    }
    
    public function postStoreAd()
    {
        if(Request::ajax()){
            $status = 400;
            $data_id = Input::get('data_id');
            $isinwl = count(Wishlist::where('ad_id',$data_id)->first());
            if ($isinwl>0) {
                return Response::json(array(
                    'status' => 201
                    ));
            }

            $wl = new Wishlist();
            $wl->user_id=Auth::id();
            $wl->ad_id=Input::get('data_id');
            $wl->status=1;
            if ($wl->save()) {
                $status = 200;
            }
            return Response::json(array(
                'status' => $status
                ));
        }
    }

        public function postSearchByText()
    {
        if(Request::ajax()){
            $status = 400;
            $ttxt = Input::get('ttxt');
            if (isset($ttxt)) {
                $ads = Ad::PrepareAdsSearchTxt($ttxt);
                $status = 200;
                return Response::json(array(
                    'status' => $status,
                    'ads' => $ads['html']
                ));
            }
            return Response::json(array(
                'status' => $status
                ));
        }
    }    

    public function postRemoveWishlist()
    {
        if(Request::ajax()){
            $status = 400;
            $data_id = Input::get('ad_id');
            $isinwl = count(Wishlist::where('ad_id',$data_id)->first());
            if ($isinwl>0) {
                $status = 200;
                $wishlist = Wishlist::where('ad_id',$data_id)->first();
                $wishlist->delete();
            }
            $wl_html = Wishlist::PrepareForHome(Wishlist::where('status',1)->where('user_id',Auth::id())->get());
            return Response::json(array(
                'status' => $status,
                'wl_html' => $wl_html
                ));
        }
    }

    public function postSearchByCategory()
    {
        if(Request::ajax()){
            $status = 400;
            $cat_id = Input::get('cat_id');
            $subcat_id = Input::get('subcat_id');
            if (isset($cat_id,$subcat_id)) {
                $ads = Ad::PrepareAdsSearchCategory($cat_id,$subcat_id);
                $status = 200;
                $render = $ads['data']->render();
                return Response::json(array(
                    'status' => $status,
                    'ads' => $ads,
                    'render' => $render,

                ));
            }
            return Response::json(array(
                'status' => $status
                ));
        }
    }
    public function postSearchByCity()
    {
        if(Request::ajax()){
            $status = 400;
            $city_id = Input::get('city_id');
            if (isset($city_id)) {
                $ads = Ad::PrepareAdsSearchCity($city_id);
                $status = 200;
                $render = $ads['data']->render();
                return Response::json(array(
                    'status' => $status,
                    'ads' => $ads,
                    'render' => $render,
                ));
            }
            return Response::json(array(
                'status' => $status
                ));
        }
    }
}
