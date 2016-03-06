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
use Mail;
use Session;
use File;
use Laracasts\Flash\Flash;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Job;
use App\User;
use App\Thread;
use App\Category;
use App\RoleUser;
use App\QuestionsNAnswer;
use App\Review;
use App\ConversationMessage;

class UsersController extends Controller
{
    public function __construct() {
        // // THIRD TEMPLATE
        $this->layout = "layouts.default";

    }

    public function getGetContent()
    {
        $new_msg = ConversationMessage::where('status',9)->get();
        // set php runtime to unlimited
        set_time_limit(0);

        $filepath = 'storage/work/checkin_poll_' . Auth::user()->id;

        $last_cycle = File::get($filepath);

        // if last cycle was > 60 secs continue
        $time_dif = time() - $last_cycle;
        Log::last($time_dif);


        while (1) {
            // if ajax request has send a timestamp, then $last_ajax_call = timestamp, else $last_ajax_call = null
            $last_ajax_call = isset($_GET['timestamp']) ? (int)$_GET['timestamp'] : null;
            // PHP caches file data, like requesting the size of a file, by default. clearstatcache() clears that cache
            clearstatcache();
            // get timestamp of when file has been changed the last time
            $last_change_in_data_file = filemtime($data_source_file);
            // if no timestamp delivered via ajax or data.txt has been changed SINCE last ajax timestamp
            if ($time_dif > 60) {
                File::put($filepath, time());
                // get content of data.txt
                $data = file_get_contents($data_source_file);
                // put data.txt's content and timestamp of last data.txt change into array
                $result = array(
                    'data_from_file' => $data,
                    'timestamp' => $last_change_in_data_file
                );
                // encode to JSON, render the result (for AJAX)
                $json = json_encode($result);
                echo $json;
                // leave this loop step
                break;
            } else {
                // wait for 1 sec (not very sexy as this blocks the PHP/Apache process, but that's how it goes)
                sleep(1);
                continue;
            }
        }
    }
    public function getRegistration()
    {
        $country_code = Job::country_code();
        return view('users.registration')
        ->with('country_code',$country_code)
        ->with('layout',$this->layout);
    }
    public function postRegistration()
    {
            $validator = Validator::make(Input::all(), User::$registration);
            if ($validator->passes()) {
                $user = new User;
                $user->roles = 5;
                $user->email = Input::get('email');
                $user->password = Hash::make(Input::get('password')); 
                $rand_sting = Job::generateRandomString(25);
                $user->verification_token = $rand_sting;
                 if($user->save()) { // Save the user and redirect to owners home
                    $rand = Request::root().'/verify-email/'.$rand_sting;
                    // $mailer_return = Job::VerificationMailer(Input::get('email'),$rand);
                    //ASSIGN LEVEL TWO ACL (GUESTS)
                    $new_rule = new RoleUser;
                    $new_rule->role_id = 5;
                    $new_rule->user_id = $user->id;
                    if($new_rule->save()) {
                        if (Auth::attempt(array('email'=> $user->email, 'password'=>Input::get('password')),true)) {
                            Flash::success('You have been successfully registered as '.$user->email.'! An activation email has been sent to your email address');
                            if(isset($redirect)) {
                                return Redirect::to(Session::get('redirect'));
                            } else {
                                //SESION DOESN'T EXIST
                                return Redirect::route('home_index');
                            }
                        }
                    }
                }

            } else {
                return Redirect::back()
                ->with('message', 'The following errors occurred')
                ->with('alert_type','alert-danger')
                ->withErrors($validator)
                ->withInput();
            }
    }

    public function getEmailVerify($id=null)
    {
        $user = User::where('verification_token',$id)->first();
        if (isset($user)) {
            $user->status = 1;
            $user->verification_token = '1';
            $user->save();
            Flash::success('Thank you for verifying your email. Hope you enjoy our services!');
        } else {
            Flash::Error('This link has been expired. Please request a new verification email.');
        }
        
        return Redirect::route('home_index');
    }

    public function getLogin()
    {
        return view('users.login')
        ->with('layout',$this->layout);
    }
    public function postLogin()
    {
        $email = Input::get('email');
        $password = Input::get('password');
        $remember = Input::get('remember');

        if (Auth::attempt(array('email'=>$email, 'password'=>$password),isset($remember)?true:false)) {
            Flash::success('Welcome back '.$email.'!');
            return redirect()->action('HomeController@postIndex');
        } else { //LOGING FAILED
            if (isset($direct_login)) {
                return view('users.login')
                    ->with('layout',$this->layout)
                    ->with('wrong',1);
            } else {
                return view('users.login')
                    ->with('layout',$this->layout)
                    ->with('wrong',1); 
            }
        }
    }   
 
    public function postLoginModal()
    {
        $email = Input::get('email');
        $password = Input::get('password');
        $remember = Input::get('remember');
        if (Auth::attempt(array('email'=>$email, 'password'=>$password),isset($remember)?true:false)) {
            Flash::success('Welcome back '.$email.'!');
        } else { //LOGIN FAILED
            Flash::error('Wrong Username or Password!');
        }
        return Redirect::route('home_index');
    }
    public function getLogout()
    {
            Auth::logout();
            return Redirect::action('HomeController@getHomepage');
    }
    public function postLogout()
    {
        Auth::logout();
        return Redirect::action('HomeController@getHomepage');
    }

    public function getProfile($username)
    {
        if (Auth::user()->username == $username) {
            $categories_for_select = Category::prepareForSelect(Category::where('status',1)->get());
            $categories_for_side = Category::prepareForSide(Category::where('status',1)->get());
            $current_user = User::find(Auth::user()->id);
            $profile_image = Job::imageValidator($current_user->profile_image);
            $email = $current_user->email;
            $fname = $current_user->firstname;
            $lname = $current_user->lastname;
            return view('users.profile')
            ->with('layout',$this->layout)
            // ->with('threads',$prepared_thread)
            ->with('categories_for_select',$categories_for_select)
            ->with('categories_for_side',$categories_for_side)
            ->with('profile_image',$profile_image)        
            ->with('email',$email)
            ->with('fname',$fname)
            ->with('lname',$lname);
        } else {
            abort(404);
        }
    }
    public function postProfile()
    {
        $validator = Validator::make(Input::all(), User::updatevalidation());
        if ($validator->passes()) {
            $user = User::find(Auth::user()->id);
            $user->firstname = Input::get('fname');
            $user->lastname = Input::get('lname');
            if ($user->save()) {
                Flash::success('Profile Successfully Updated');
                return Redirect::action('UsersController@getProfile',$user->username);
            //     $redirect = (Session::get('redirect')) ? Session::get('redirect') : null; 
            //     if(isset($redirect)) {
            //        return Redirect::to(Session::get('redirect'));
            //    } else {
            //         //SESION DOESN'T EXIST
            //     return Redirect::to('/');
            // }
        }
    } else {
            // validation has failed, display error messages    
        return Redirect::back()
        ->with('message', 'The following errors occurred')
        ->with('alert_type','alert-danger')
        ->withErrors($validator)
        ->withInput();
    }
}

public function postValidate()
{
    if(Request::ajax()){
        $reg_form = null;
        parse_str(Input::get('reg_form'), $reg_form);
        $validation_results = Job::validate_data($reg_form);
    
        return Response::json(array(
            'status' => 200,
            'validation_callback' => $validation_results
            ));
    }
}

public function postUserAuth()
{
    if(Request::ajax()){
        $status = 400;
        if (Auth::check()) {
            $status = 200;
        }
        return Response::json(array(
            'status' => $status
            ));
    }
}

public function postSendFile()
{
    if(Request::ajax()){
        $status = 400;
        $imagePath = public_path("assets/images/profile-images/perm/");
        $imagename = $_FILES[0]['name'];
        $imagetemp = $_FILES[0]['tmp_name'];
        $image_ex = explode('.', $imagename);
        $image_type = $image_ex[1];
        $now_time = time();
        $new_imagename = $now_time . '-' . $imagename[0];
            // check if $folder is a directory
        if( ! \File::isDirectory($imagePath) ) {
                // Params:
                // $dir = name of new directory
                //
                // 493 = $mode of mkdir() function that is used file File::makeDirectory (493 is used by default in \File::makeDirectory
                //
                // true -> this says, that folders are created recursively here! Example:
                // you want to create a directory in company_img/username and the folder company_img does not
                // exist. This function will fail without setting the 3rd param to true
                // http://php.net/mkdir  is used by this function

            \File::makeDirectory($imagePath, 493, true);
        }
        if (!is_writable(dirname($imagePath))) {
            Job::dump('DIRECTORY IS NOT WRITEABLE');
            $status = 401;
            return Response::json(array(
                "error" => 'Destination Unwritable'
                ));
        } else {

            $final_path = preg_replace('#[ -]+#', '-', $new_imagename);

            if (move_uploaded_file($imagetemp, $imagePath . $final_path.'.'.$image_type)) {
                $status = 200;
                    //SAVE THE NEW IMAGE NAME INTO USERS TABLE
                $user = User::find(Auth::user()->id);
                    //DELETE USERS PREVIOUS IMAGE
                if ($user->profile_image != 'blank_male.png') {
                    $old_image = public_path("assets/images/profile-images/perm/".$user->profile_image);
                    if (file_exists($old_image)) {
                        unlink($old_image);
                    }
                }

                $user->profile_image = $final_path.'.'.$image_type;
                $db_imagepath = null;
                if ($user->save()) {
                 $db_imagepath = $user->profile_image;
             }
             return Response::json(array(
                'status' => 'success',
                "image_name" => $new_imagename,
                "image_type" => $image_type
                ));
         }
     }
     return Response::json(array(
        'error' => 'error'
        ));
 }
}

public function postSendFileTemp()
{
    if(Request::ajax()){
            // $imagePath = "img/tmp/";
        $status = 400;
        $imagePath = public_path("assets/images/profile-images/tmp/");
        $imagename = $_FILES[0]['name'];
        $imagetemp = $_FILES[0]['tmp_name'];

        $image_ex = explode('.', $imagename);
        $image_type = $image_ex[1];

        $now_time = time();
        $new_imagename = $now_time . '-' . $imagename[0];
            // check if $folder is a directory
        if( ! \File::isDirectory($imagePath) ) {

                // Params:
                // $dir = name of new directory
                //
                // 493 = $mode of mkdir() function that is used file File::makeDirectory (493 is used by default in \File::makeDirectory
                //
                // true -> this says, that folders are created recursively here! Example:
                // you want to create a directory in company_img/username and the folder company_img does not
                // exist. This function will fail without setting the 3rd param to true
                // http://php.net/mkdir  is used by this function

            \File::makeDirectory($imagePath, 493, true);
        }
        if (!is_writable(dirname($imagePath))) {
            $status = 401;
            return Response::json(array(
                "error" => 'Destination Unwritable'
                ));
        } else {
            $final_path = preg_replace('#[ -]+#', '-', $new_imagename);
            if (move_uploaded_file($imagetemp, $imagePath . $final_path.'.'.$image_type)) {
                $status = 200;
                return Response::json(array(
                    'status' => 'success',
                    "image_name" => $new_imagename,
                    "image_type" => $image_type
                    ));
            }
        }
        return Response::json(array(
            'error' => 'error'
            ));

    }
}
public function postReturnUsers()
{
    if(Request::ajax()){
        $status = 400;
        if (Auth::check()) {
            $search = Input::get('search');
            $users = array();
            $status = 200;
            $message = 'Successfully found users!';
            if($search) {
                foreach ($search as $key => $value) {
                    $type = $key;
                    switch ($type) {
                        case 'name':
                        $first_name = $value['first_name'];
                        $last_name = $value['last_name'];
                        $users = User::where('firstname','LIKE','%'.$first_name.'%')
                            ->where('lastname','LIKE','%'.$last_name.'%')
                            ->get();

                        if(count($users) == 0){
                            $status = 401;
                            $message = 'No such name.';
                        }
                        break;
                        default:
                        foreach ($value as $column_name => $column_value) {
                            $users = User::where($column_name,'LIKE','%'.$column_value.'%')->get();
                        }

                        if(count($users) == 0) {
                            $status = 401;
                            $message = 'No such user';
                        }
                        break;
                    }
                }
            }

            $users_tbody = User::PrepareUsersData($users);
            return Response::json(array(
                'status' => $status,
                'message' => $message,
                'users_tbody'   => $users_tbody
                ));
        }
    }
}
public function postInvoiceUsers()
{
    if(Request::ajax()){
        $status = 400;
        if (Auth::check()) {
            $search = Input::get('search');
            $users = array();
            $status = 200;
            $message = 'Successfully found users!';
            if($search) {
                foreach ($search as $key => $value) {
                    $type = $key;
                    switch ($type) {
                        case 'name':
                        $first_name = $value['first_name'];
                        $last_name = $value['last_name'];
                        $users = User::where('firstname','LIKE','%'.$first_name.'%')
                            ->where('lastname','LIKE','%'.$last_name.'%')
                            ->get();

                        if(count($users) == 0){
                            $status = 401;
                            $message = 'No such name.';
                        }
                        break;
                        default:
                        foreach ($value as $column_name => $column_value) {
                            $users = User::where($column_name,'LIKE','%'.$column_value.'%')->get();
                        }

                        if(count($users) == 0) {
                            $status = 401;
                            $message = 'No such user';
                        }
                        break;
                    }
                }
            }
            $user_data = ['users_tbody' => '', 'user' => '']; 
            $user_data['users_tbody'] = User::PrepareUsersDataInvoice($users);
            $user_data['user'] = $users;
            return Response::json(array(
                'status' => $status,
                'message' => $message,
                'user_data'   => $user_data
                ));
        }
    }
}

public function postUserInfo()
{
    if(Request::ajax()){
        $status = 400;
        if (Auth::check()) {
            $id = Input::get('id');
            $users = User::find($id);
            if (isset($users)) {
                $status = 200;
            }
            return Response::json(array(
                'status' => $status,
                'users' => $users
                ));
        }
    }
}


public function postUsersAuthCheck()
{
    if(Request::ajax()){
        $status = 400;
        if (Auth::check()) {
            $status = 200;
        }
        return Response::json(array(
        'status' => $status
        ));
    }
}

public function postUsersAuthCheckReview()
{
    if(Request::ajax()){
        $status = 400;
        if (Auth::check()) {
            $inventory_id = Input::get('inventory_id');
            $p_reviews = Review::where('user_id',Auth::user()->id)->where('inventory_id',$inventory_id)->first();
            $status = isset($p_reviews)?201:200;
        }
        return Response::json(array(
        'status' => $status
        ));
    }
}







}
