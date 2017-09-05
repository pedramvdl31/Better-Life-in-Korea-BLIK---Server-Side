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
    	$data_array=null;
    	if (isset($this_user)) {
    		$data_array=array();
            $count = 0 ;
    		$followingyou = Follow::where('followe_id',$this_user->id)->get();
    		if ($followingyou) {
    			foreach ($followingyou as $flk => $flv) {
                    $data_array[$count]['date'] = $flv->created_at;
                    $data_array[$count]['type'] = 'follower';
                    $data_array[$count]['m'] = date('M', strtotime($flv->created_at));
                    $data_array[$count]['m'] = date('M', strtotime($flv->created_at));
                    $data_array[$count]['j'] = date('j', strtotime($flv->created_at));
					$user_follower = User::find($flv->follower_id);
					if ($user_follower) {
                        $data_array[$count]['email'] = $user_follower->email;
                        $data_array[$count]['id'] = $user_follower->id;
					}
                    $count++;
    			}
    		}

    		//you are following
    		$followee = Follow::where('follower_id',$this_user->id)->get();
    		if ($followee) {
    			foreach ($followee as $flek => $flev) {
                    $data_array[$count]['date'] = $flev->created_at;
                    $data_array[$count]['type'] = 'following';
                    $data_array[$count]['m'] = date('M', strtotime($flev->created_at));
                    $data_array[$count]['j'] = date('j', strtotime($flev->created_at));
					$user_followee = User::find($flev->followe_id);
					if ($user_followee) {
                        $data_array[$count]['email'] = $user_followee->email;
                        $data_array[$count]['id'] = $user_followee->id;
					}
                    $count++;
    			}
    		}
    	}

        usort($data_array, 'compare');
        return $data_array;
    }
}
function compare($a, $b)
{
    return strtotime($a['date']) - strtotime($b['date']);
}
