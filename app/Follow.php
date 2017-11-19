<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
use File;
use App\Follow;
class Follow extends Model
{
    static public function PrepareFollowPageData($this_user) {
		$data_array=array();
        $count = 0 ;
		$all_f = Follow::where('status',1)->where('followe_id',$this_user->id)->orWhere('follower_id',$this_user->id)->orderBy('created_at','desc')->get();
        if ($all_f) {
            foreach ($all_f as $k => $flv) {
                $data_array[$k]['date'] = $flv->created_at;
                $data_array[$k]['email'] = '';
                $data_array[$k]['id'] = '';
                if ($flv->follower_id == $this_user->id) {
                    $data_array[$k]['type'] = 'follower';
                    $user_followe = User::find($flv->followe_id);
                    if ($user_followe) {
                        $data_array[$k]['email'] = $user_followe->email;
                        $data_array[$k]['id'] = $user_followe->id;
                    }
                } else {
                    $data_array[$k]['type'] = 'following';
                    $user_follower = User::find($flv->follower_id);
                    if ($user_follower) {
                        $data_array[$k]['email'] = $user_follower->email;
                        $data_array[$k]['id'] = $user_follower->id;
                    }
                }
                $data_array[$k]['m'] = date('M Y', strtotime($flv->created_at));
                $data_array[$k]['j'] = date('j', strtotime($flv->created_at));
                $count++;
            }
        }

        return $data_array;
    }



}

