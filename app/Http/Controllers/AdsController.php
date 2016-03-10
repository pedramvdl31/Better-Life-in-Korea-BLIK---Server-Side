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
            $description = $_form['description'];
            $posted_files = isset($_form['posted_files'])?$_form['posted_files']:null;

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
    public function getPostsRemove($id = null)
    {

        if (isset($id)) {
            $ps = Ad::find($id);
            if (isset($ps)) {
                if ($ps->delete()) {
                    Flash::success('Successfully Removed');
                    return Redirect::route('dash_view_posts');
                }
            }
        }
        Flash::error('Oops somthing went wrong!');
        return Redirect::route('dash_view_posts');
    }

}
