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


    }
    
    public function postRtrnMsgs()
    {
        $cu = Auth::id();
        $fi = Input::get('fi');
        $convs = Conversation::
            where(function ($query) use ($cu) {
                $query->where('user_one',$cu)
                      ->orWhere('user_two',$cu);
            })
            ->where(function ($query) use ($fi) {
                $query->where('user_one',$fi)
                      ->orWhere('user_two',$fi);
            })
            ->first();
        if (isset($convs)) {
            $l_mgs = ConversationMessage::
                                where('conv_id',$convs['id'])
                                ->orderBy('id', 'desc')
                                ->take(15)
                                ->get()
                                ->reverse();
            foreach ($l_mgs as $k => $v) {
                $v['ago'] =Job::formatTimeAgo(Job::humanTiming($v['created_at']));
            }

            return Response::json(array(
            'status' => 200,
            'l_mgs' => $l_mgs
            ));
        }
        return Response::json(array(
            'status' => 400
            ));
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
                    return Response::json(array(
                        'status' => $status,
                        'aid' => $thisuser,
                        'tcat' => date ( 'Y-m-d H:i:s',  strtotime($new_message->created_at) )
                        ));
                }
            }

            return Response::json(array(
                'status' => 400
                ));
        }
    }

}
