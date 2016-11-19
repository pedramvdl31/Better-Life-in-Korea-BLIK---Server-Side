<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Validator;
use Redirect;
use Response;
use Auth;
use View;
use Hash;
use App\RoleUser;
use App\Job;
use App\User;
use App\Admin;
use App\Ad;
use App\Review;

class ApisController extends Controller
{
    public function postInit() {
            return Response::json(array(
            'status' => 200
            ));
    }
    public function postLogin() {
            $status = 400;
            $_form = null;
            $tkn = null;
            $email = Input::get('email');
            $password = Input::get('password');
            if (Auth::attempt(array('email'=>$email, 'password'=>$password))) {
                $tkn = Job::generateRandomString(60);
                $cu = User::where('email',$email)->first();
                $cu->api_token=$tkn;
                $cu->save();
                $status = 200;
            }



            return Response::json(array(
            'status' => $status,
            'tkn' => $tkn
            ));

    }
    public function postFBLogin() {
            $status = 400;
            $email = Input::get('email');
            $token = Input::get('token');
            $tuser = User::where('email',$email)->first();
            if (isset($email,$token)) {
                if (isset($tuser) && !empty($tuser)) {
                    if (!isset($tuser->api_token)) {
                        $tuser->api_token = $token;
                        $tuser->save();
                    }
                    Auth::loginUsingId($tuser->id, true);
                    return Response::json(array(
                    'status' => 200,
                    'tkn'=>$tuser->api_token
                    ));
                } else {
                    $rand_sting = Job::generateRandomString(25);
                    $user = new User;
                    $user->roles = 5;
                    $user->email = $email;
                    $user->password = Hash::make('facebookloginpassword##**'); 
                    $user->api_token=$token;
                    $user->verification_token = $rand_sting;
                     if($user->save()) { // Save the user and redirect to owners home
                        $new_rule = new RoleUser;
                        $new_rule->role_id = 5;
                        $new_rule->user_id = $user->id;
                        if($new_rule->save()) {
                            Auth::loginUsingId($user->id, true);
                            return Response::json(array(
                                'status' => 200,
                                'tkn'=>$token
                                ));
                        }
                    }                
                }
            }

            return Response::json(array(
            'status' => $status
            ));

    }
    public function postUpdateAds() {
            $status = 400;
            $cat_id = Input::get('cat_id');
            $cit = Input::get('city_id');
            if (isset($cat_id,$cit)) {
                $ads = Ad::PrepareAdsSearchCategoryApi($cat_id,$cit);
                $status = 200;
                return Response::json(array(
                    'status' => $status,
                    'ads' => $ads
                ));
            }
            return Response::json(array(
                'status' => $status
                ));
    }
    public function postUpdateAdsLoc() {
            $status = 400;
            $cat_id = Input::get('cat_id');
            $lat = Input::get('lat');
            $lng = Input::get('lng');
            $radius = Input::get('radius');
            if (!isset($radius) || empty($radius)) {
                $radius=25;
            }
            if (isset($cat_id,$lat,$lng,$radius)) {
                $ads = Ad::PrepareAdsSearchCategoryApiLoc($cat_id,$lat,$lng,$radius);
                $status = 200;
                return Response::json(array(
                    'status' => $status,
                    'ads' => $ads
                ));
            }
            return Response::json(array(
                'status' => $status
                ));
    }



    public function postMoreAds()
    {
        $status = 400;
        $cat_id = Input::get('cat_id');
        $cit = Input::get('city_id');

        if ($cit==0||$cit=='0') {
            $ads = Ad::PrepareAdsScrollLoadApi(Ad::where('status',1)->where('cat_id',$cat_id)->orderBy('id', 'desc')->skip(Input::get('ad_num'))->take(8)->get());
        } else {
            $ads = Ad::PrepareAdsScrollLoadApi(Ad::where('status',1)->where('cat_id',$cat_id)->where('city',$cit)->orderBy('id', 'desc')->skip(Input::get('ad_num'))->take(8)->get());
        }

        return Response::json(array(
            'html_data' => $ads
            ));
    }


    public function postPrepareAds()
    {
        $status = 400;
        $this_ad = Ad::PrepareForViewApi(Ad::find(Input::get('data_id')));
        if (isset($this_ad)) {
            return Response::json(array(
                'status' => 200,
                'ad_array' => $this_ad
                ));
        }
        //else
        return Response::json(array(
            'status' => $status
            ));
    }

    public function postQkpst()
    {
        $status = 200;
        $_form = null;
        $tkn = Input::get('tkn');
        if (isset($tkn)) {
            $this_user = User::where('api_token',$tkn)->first();
            if (isset($this_user)&&!empty($this_user)) {
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
                $ThisUserId = $this_user->id;
                //ELSE
                $ads = new Ad();
                $ads->user_id = $ThisUserId;
                $ads->cat_id = $cat;
                $ads->subcat_id = $subcat;
                $ads->city = $city;
                $ads->lng = $_long;
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
            }
        }

        return Response::json(array(
            'status' => $status
            ));
    }


    public function postAdsImageTmp()
    {
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


    public function postValidate()
    {
        $reg_form = null;
        parse_str(Input::get('reg_form'), $reg_form);
        $validation_results = Job::validate_data($reg_form);

        return Response::json(array(
            'status' => 200,
            'validation_callback' => $validation_results
            ));
    }

    public function postRegistration()
    {
        $reg_form = null;
        parse_str(Input::get('reg_form'), $reg_form);
        $validator = Validator::make($reg_form, User::$registration);
        if ($validator->passes()) {
            $tkn = Job::generateRandomString(60);
            $rand_sting = Job::generateRandomString(25);

            $user = new User;
            $user->roles = 5;
            $user->email = $reg_form['email'];
            $user->password = Hash::make($reg_form['password']); 
            $user->api_token=$tkn;
            $user->verification_token = $rand_sting;
             if($user->save()) { // Save the user and redirect to owners home
                $new_rule = new RoleUser;
                $new_rule->role_id = 5;
                $new_rule->user_id = $user->id;
                if($new_rule->save()) {
                    if (Auth::attempt(array('email'=> $user->email, 'password'=>$reg_form['password']),true)) {
                        return Response::json(array(
                            'status' => 200,
                            'tkn'=>$tkn
                            ));
                    }
                }
            }

        }
        return Response::json(array(
        'status' => 400
        ));
    }
    public function postSaveRate()
    {
            $status = 400;
            $rate = Input::get('rate');
            $data_id = Input::get('data_id');
            $nrate = (float)$rate;
            if ( ($rate!='') && ($rate>=0) && ($rate<=10) ) {
                $user_id=Auth::id();
                $pre_rate = Review::where('ad_id',$data_id)->where('user_id',$user_id)->first();
                //IF THIS USER ALREADY RATED REMOVE THE PREVIOUS RATE
                if (isset($pre_rate)) {
                    $pre_rate->delete();
                }

                //SAVE THE NEW RATE
                $new_rev = new Review();
                $new_rev->user_id = $user_id;
                $new_rev->ad_id = $data_id;
                $new_rev->rate = $nrate;
                if ($new_rev->save()) {
                    //IF SAVED RETURN
                    return Response::json(array(
                        'status' => 200
                        ));
                }

            }
            return Response::json(array(
                'status' => $status
                ));
    }

}
