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
use App\Comment;
use Image;
use URL;
class ApisController extends Controller
{
    public function __construct() {
        $this->layout = 'layouts.fbcomments';
    }
    public function postInit() {
        $tkn = Input::get('token');
        $obf_email = "Default";
        $this_user = User::where('api_token',$tkn)->first();
        $status = 400;
        if (isset($this_user)&&!empty($this_user)) {
            $obf_email = Job::obfuscate_email($this_user->email);
            $status = 200;
        }
        return Response::json(array(
            'status' => $status,
            'obf_email' => $obf_email
        ));
    }
    public function postProfileInfo() {
        $tkn = Input::get('tkn');
        $obf_email = "Default";
        $num_posts = "0";
        $this_user = User::where('api_token',$tkn)->first();
        $status = 400;
        if (isset($this_user)&&!empty($this_user)) {
            $obf_email = Job::obfuscate_email($this_user->email);
            $num_posts = count(Ad::where('status','1')->where('user_id',$this_user->id)->get());
            $status = 200;
        }
        return Response::json(array(
            'status' => $status,
            'num_posts' => $num_posts,
            'obf_email' => $obf_email
        ));
    }


    public function postPostComment() {
        $status = 400;
        $rhtml = '';
        $tkn = Input::get('token');
        $postid = Input::get('post_id');
        $ncom = Input::get('comment');
        $rate = Input::get('rate');
        if (isset($tkn,$postid,$ncom)) {
            $this_user = User::where('api_token',$tkn)->first();
            if (isset($this_user)&&!empty($this_user)) {

                $pcom = Comment::where('user_id',$this_user->id)->where('post_id',$postid)->first();
                if (isset($pcom)&&!empty($pcom)) {
                    return Response::json(array(
                    'status' => 401,
                    'rhtml'=>''
                    ));
                }

                $com = new Comment();
                $com->user_id = $this_user->id;
                $com->post_id = $postid;
                $com->comment = $ncom;
                $com->status = 1;
                $user_id = $this_user->id;
                $nrate = (float)$rate;
                if ($com->save()) {
                    $rhtml ='<li tc="'.$com->id.'" class="clearfix coli">
                                  <div class="post-comments">
                                      <p class="meta">'.date("M j Y", strtotime($com['created_at'])).' <a href="#">'.substr($this_user['email'], 0, 4).'***</a> says :<i class="pull-right"><a class="delcom" href="#"><small>Delete</small></a></i><span class="comrw pull-right"><input name="input-name" type="number" class="rating comrate nrate" min=1 max=10 step=0.5 data-size="xs" data-rtl="false" disabled="true" value="'.$nrate.'"></span></p>
                                      <p>
                                          '.$ncom.'
                                      </p>
                                  </div>
                                </li>';
                    if ( ($rate!='') && ($rate>=0) && ($rate<=10) ) {
                        $pre_rate = Review::where('ad_id',$postid)->where('user_id',$user_id)->first();
                        //IF THIS USER ALREADY RATED REMOVE THE PREVIOUS RATE
                        if (isset($pre_rate)) {
                            $pre_rate->delete();
                        }
                        //SAVE THE NEW RATE
                        $new_rev = new Review();
                        $new_rev->user_id = $user_id;
                        $new_rev->ad_id = $postid;
                        $new_rev->rate = $nrate;
                        $new_rev->save();
                    }
                    $status = 200;
                }
            }
        }

        return Response::json(array(
        'status' => $status,
        'rhtml'=>$rhtml
        ));
    }
    public function postDelComment() {
        $status = 400;
        $tkn = Input::get('token');
        $comid = Input::get('com_id');
        if (isset($tkn,$comid)) {
            $this_user = User::where('api_token',$tkn)->first();
            if (isset($this_user)&&!empty($this_user)) {
                $tcomnt = Comment::where('id',$comid)->first();
                if (isset($tcomnt)&&!empty($tcomnt)) {
                    if ($tcomnt->user_id == $this_user->id) {
                        if ($tcomnt->delete()) {
                            $status = 200;
                        }
                    }
                }
            }
        }
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
            $obf_email = "Default";
            if (Auth::attempt(array('email'=>$email, 'password'=>$password))) {
                $obf_email = Job::obfuscate_email($email);
                $tkn = Job::generateRandomString(60);
                $cu = User::where('email',$email)->first();
                $cu->api_token=$tkn;
                $cu->save();
                $status = 200;
            }
            return Response::json(array(
            'status' => $status,
            'tkn' => $tkn,
            'obf_email' => $obf_email
            ));
    }
    public function postFBLogin() {
            $status = 400;
            $email = Input::get('email');
            $token = Input::get('token');
            $tuser = User::where('email',$email)->first();
            $obf_email = "Default";
            if (isset($email,$token)) {
                $obf_email = Job::obfuscate_email($email);
                if (isset($tuser) && !empty($tuser)) {
                    if (!isset($tuser->api_token)) {
                        $tuser->api_token = $token;
                        $tuser->save();
                    }
                    Auth::loginUsingId($tuser->id, true);
                    return Response::json(array(
                    'status' => 200,
                    'tkn'=>$tuser->api_token,
                    'obf_email' => $obf_email
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
                                'tkn'=>$token,
                                'obf_email' => $obf_email
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
            $headers = array (
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );
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
                ),200,$headers,JSON_UNESCAPED_UNICODE);
            }
            return Response::json(array(
                'status' => $status
                ));
    }

    public function postViewAdsOnMap() {
            $headers = array (
                'Content-Type' => 'application/json; charset=UTF-8',
                'charset' => 'utf-8'
            );
            $status = 400;
            $cat_id = Input::get('cat_id');
            $lat = Input::get('lat');
            $lng = Input::get('lng');
            $radius = Input::get('radius');
            $ads = '';
            if (!isset($radius) || empty($radius)) {
                $radius=30;
            } else {
                $radius += 5;
            }
            if (isset($cat_id,$lat,$lng,$radius)) {

                if (preg_match_all('/#([\p{L}\p{Mn}]+)/u',$cat_id,$matches)) {
                    if (isset($matches[0][0])) {
                        $htag = $matches[0][0];
                        $ads = Ad::PrepareAdsMapHashtag($htag,$lat,$lng,$radius);
                    }
                } else {
                    $ads = Ad::PrepareAdsMap($cat_id,$lat,$lng,$radius);
                }
                $status = 200;
                return Response::json(array(
                    'status' => $status,
                    'ads' => $ads
                ),200,$headers,JSON_UNESCAPED_UNICODE);
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
        $this_ad = Ad::PrepareForViewApi(Ad::find(Input::get('data_id')),Input::get('user_token'));
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
                // $subcat = $_form['subcat'];
                $title = $_form['title'];
                $_long = isset($_form['long'])?$_form['long']:null;
                $_lat = isset($_form['lat'])?$_form['lat']:null;
                $description = $_form['description'];
                preg_match_all('/#([\p{L}\p{Mn}]+)/u',$description,$matches);
                $hashtags = '';
                if (isset($matches[0])) {
                    $hashtags = serialize($matches[0]);
                }
                $posted_files = isset($_form['posted_files'])?$_form['posted_files']:NULL;

                if (empty($cat) ||  empty($title) || empty($description)) {
                    return Response::json(array(
                        'status' => 400
                    ));
                }
                $ThisUserId = $this_user->id;
                //ELSE
                $ads = new Ad();
                $ads->user_id = $ThisUserId;
                $ads->cat_id = $cat;
                // $ads->subcat_id = $subcat;
                $ads->lng = $_long;
                $ads->lat = $_lat;
                $ads->title = $title;
                $ads->description = json_encode($description);
                $ads->htag = $hashtags;
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
                                    $filetmp = $tmp_path.$pvval['name'];
                                    if (file_exists($filetmp)) {

                                        $img = Image::make($oldpath);
                                        $img->resize(700, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                                        if ($img->save($oldpath,100)) {
                                            rename($oldpath, $newpath);
                                        }
                                        
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

        $utoken = $_POST['usertoken'];

        if (isset($utoken)) {

            $this_user = User::where('api_token',$utoken)->first();
            if (isset($this_user) && isset($this_user->id)) {
                $thisuid = $this_user->id;
                // Auth::loginUsingId($thisuid, true);
                $type_array = explode('/', $image_types);
                $type = $type_array[1];
                $base_type = $type_array[0];
                if ($base_type == "image") {
                    $imagePath = public_path('assets/images/posts/'.$thisuid.'/tmp/image');
                } elseif ($base_type == "video") {
                    $imagePath = public_path('assets/images/posts/'.$thisuid.'/tmp/video');
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
        $obf_email = "Default";
        $validator = Validator::make($reg_form, User::$registration);
        if ($validator->passes()) {
            $tkn = Job::generateRandomString(60);
            $rand_sting = Job::generateRandomString(25);
            $obf_email = $reg_form['email'];
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
                            'tkn'=>$tkn,
                            'obf_email' => $obf_email
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

    public function getFBComments($id=null,$actkn=null)
    {   
        if (isset($id,$actkn)) {
            return view('fb.comments')
                ->with('pid',$id)
                ->with('actkn',$actkn)
                ->with('layout',$this->layout);
        }

    }
    public function getAppUrlHandler($id=null)
    {   
        $status = 400;
        $nimgpath = '';
        $new_pathx = '';
        $arraykeyt = 0;
        $firstkey = 0;
        if (!isset($id)) {
            $id = 0;
        } else {

            $this_post = Ad::where('id',$id)->first();
            if (!empty($this_post) && isset($this_post)) {
                $poster_id = $this_post->user_id;
                $src_temp = json_decode($this_post['file_srcs'],true);
                foreach ($src_temp as $key => $value) {
                    if ($arraykeyt == 0) {
                        $firstkey = $key;
                    }
                    $arraykeyt++;
                }
                
                $f_image = ( isset($src_temp[$firstkey]['image']['name']) )?'/assets/images/posts/'.$poster_id.'/prm/image/'.$src_temp[$firstkey]['image']['name']:'/assets/images/home/product1.jpg';
                $thisimgpath = public_path($f_image);
                if (file_exists($thisimgpath)) {
                    $rand = Job::generateRandomString(5);
                    $time = time();
                    $final_path = $rand.'_'.$time.'.jpg';
                    $new_pathx = URL::to('/')."/assets/images/urlsharing/".$final_path;
                    $new_path = "assets/images/urlsharing/".$final_path;
                    $nimgpath = public_path($new_path);
                    
                    $img = Image::make($thisimgpath);
                    $img->fit(200, 200);
                    if ($img->save($nimgpath,70)) {
                        $status = 200;
                    }
                } 
            }
        }

        return view('home.urlhandler')
            ->with('adid',$id)
            ->with('img_path',$new_pathx)
            ->with('layout',"layouts.urlhandler");

    }
    public function postLoadAds()
    {   
        $headers = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $status = 400;
        $lat = Input::get('lat');
        $lng = Input::get('lng');
        $take_ad = Input::get('take_ad');
        $skip_ad = Input::get('skip_ad');
        $skip_ad = $skip_ad + 1;//WHAT IS THIS?????
        if (isset($lat,$lng)) {
            $ads = Ad::PrepareAdsMapAjax($take_ad,$skip_ad,$lat,$lng);
            $status = 200;
            return Response::json(array(
                'status' => $status,
                'ads' => $ads
            ),200,$headers,JSON_UNESCAPED_UNICODE);
        }

        return Response::json(array(
            'status' => $status
            ));
    }
    public function postLoadAdsProfile()
    {   
        $headers = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );
        $status = 400;
        $lat = Input::get('lat');
        $lng = Input::get('lng');
        $tkn = Input::get('tkn');
        $take_ad = Input::get('take_ad');
        $skip_ad = Input::get('skip_ad');
        if (isset($lat,$lng)) {
            $ads = Ad::PrepareAdsMapAjaxProfile($take_ad,$skip_ad,$tkn,$lat,$lng);
            $status = 200;
            return Response::json(array(
                'status' => $status,
                'ads' => $ads
            ),200,$headers,JSON_UNESCAPED_UNICODE);
        }

        return Response::json(array(
            'status' => $status
            ));
    }


}
