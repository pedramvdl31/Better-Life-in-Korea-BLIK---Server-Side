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
use App\Relationship;
use App\Conversation;
use App\ConversationMessage;

class ConversationsController extends Controller
{
    public function __construct() {
      // Define layout

       if (Auth::user()) {
            switch (Auth::user()->roles) {
                case 1:
                    $this->layout = 'layouts.admins';
                    break;
                case 2:
                    $this->layout = 'layouts.admins';
                    break;
                case 3:
                    $this->layout = 'layouts.admins_simple';
                    break;
                
                default:
                    # code...
                    break;
            }
        } 


    }

    public function postSaveChatMessage()
    {
        if(Request::ajax()){

            $status = 400;
            $fi = Input::get('fi');
            $tdata = Input::get('tdata');
            $thisuser = Auth::id();
            if (isset($fi,$thisuser,$tdata)) {
                $convs = Conversation::where('status',1)
                            ->where('user_one',$fi)
                            ->orWhere('user_one',$thisuser)
                            ->where('user_two',$fi)
                            ->orWhere('user_two',$thisuser)
                            ->first();
                if (!isset($convs)) {
                    $convs = new Conversation();
                    $convs->user_one = $thisuser;
                    $convs->user_two = $fi;
                    $convs->ip = Request::getClientIp();
                    $convs->status = 1;
                    $convs->save();
                }
                //Save Message
                $new_message = new ConversationMessage();
                $new_message->user_id = $thisuser;
                $new_message->conv_id = $convs->id;
                $new_message->message = e(trim($tdata));
                $new_message->status = 1;
                if ($new_message->save()) {
                    $status = 200;
                }
            }


            

            return Response::json(array(
                'status' => $status
                ));
        }
    }

}
