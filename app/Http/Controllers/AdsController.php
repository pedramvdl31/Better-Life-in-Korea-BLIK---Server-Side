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
            $description = $_form['cat'];
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
            $ads->title = $title;
            $ads->description = $description;
            $ads->file_srcs = json_encode($posted_files);
            if ($ads->save()) {
                if (isset($posted_files) && !empty($posted_files)) {
                    $tmp_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."posts".DIRECTORY_SEPARATOR.$ThisUserId.DIRECTORY_SEPARATOR."tmp".DIRECTORY_SEPARATOR;
                    $new_path = "assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."posts".DIRECTORY_SEPARATOR.$ThisUserId.DIRECTORY_SEPARATOR."prm".DIRECTORY_SEPARATOR;
                    if (!file_exists($tmp_path)) {
                        mkdir($tmp_path, 0777, true);
                    }               
                    if (!file_exists($new_path)) {
                        mkdir($new_path, 0777, true);
                    }               
                    foreach ($posted_files as $pk => $pv) {
                        $oldpath = public_path($tmp_path.$pv['name']);
                        $newpath = public_path($new_path.$pv['name']);
                        if (file_exists($tmp_path.$pv['name'])) {
                            rename($oldpath, $newpath);
                        }   
                    }

                    $files = glob($tmp_path.'*'); // get all file names
                    foreach($files as $file){ // iterate files
                      if(is_file($file))
                        unlink($file); // delete file
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

            $imagePath = public_path('assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.Auth::user()->id.DIRECTORY_SEPARATOR.'tmp');
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
                        'old_name' => $image_name
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
}
