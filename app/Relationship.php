<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    static public function PrepareFriendsHtmlForChat($data) {
    	$html = '';
        if (isset($data)) {
            foreach ($data as $dkey => $dvalue) {
            	$friend_id = ($dvalue->user_one == Auth::user()->id)?$dvalue->user_two:$dvalue->user_one;
            	$friend_data = User::find($friend_id);
            	if (isset($friend_data)) {
            		$new_email = strlen($friend_data->email) > 15 ? substr($friend_data->email,0,15)."..." : $friend_data->email;
            		$ntt = strlen($friend_data->email) > 15 ? true : false;
            		$html .= '<div class="conv-wrapper pointer"';
            		if ($ntt==true) {
            		 	$html .= 'data-toggle="tooltip" data-placement="top" title="'.$friend_data->email.'"';
            		 }
            		//this is right
            		$html .= '>
								    <i class="lfloat _4xia img sp_BNtOXyg0vlE sx_78fc23"></i>
								    <img src="/assets/images/home/product4.jpg" alt="" />
								    <span>'.$new_email.'</span>
								    <span class="label label-success conv-c">2</span>
								</div>';
            	}
            }
        }
        return $html;
    }
}
