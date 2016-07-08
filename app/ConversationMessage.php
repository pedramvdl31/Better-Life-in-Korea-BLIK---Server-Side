<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Job;
use Auth;
use App\Page;
use App\Relationship;
use App\Conversation;
use App\ConversationMessage;
class ConversationMessage extends Model
{
    protected $table = 'conv_msgs';


    static public function PrepareChatHtml($relations,$tu) {
    	$html = '';
    	if(isset($relations,$tu)) {
    		$friend_id = null;
    		$sp = DIRECTORY_SEPARATOR;
    		$uip = $sp."assets".$sp."images".$sp."profile-images".$sp."perm".$sp;
    		//find friend id
    		foreach ($relations as $fk => $fv) {
    			$friend_id = ($fv['user_one']==$tu)?$fv['user_two']:$fv['user_one'];
	    		//get last 10 messages
	    		if (isset($friend_id)) {
	    			$html .= ConversationMessage::fd($friend_id,$uip);
	    		}
    		}
    	}

    	return $html;
    }
    static private function fd($fid,$uip) {
    	$html = '';
	    $fd = User::find($fid);
	    if (isset($fd)) {
		    $fi1 = (isset($fd->avatar))?$uip.$fd->avatar:$uip.'blank_male.png';
			$new_email = strlen($fd->email) > 15 ? substr($fd->email,0,15)."..." : $fd->email;
			$ntt = strlen($fd->email) > 15 ? true : false;
			$html .= '<div class="fwrapper conv-wrapper pointer" init="" tf="'.$fid.'"';
			if ($ntt==true) {
			 	$html .= 'data-toggle="tooltip" data-placement="top" title="'.$fd->email.'"';
			 }
			//this is right
			$html .= '>
							<i class="on-sign-'.$fid.' hide lfloat _4xia img sp_P9ChxUVwaFx sx_74fd99"></i>
						    <img src="'.$fi1.'" alt="" />
						    <span class="_femail">'.$new_email.'</span>
						    <span class="conv-c hide"><i class="fa fa-envelope-o"></i></span>
						</div>';
			return $html;
	    }

    }


    static private function mks($_lm,$_tu,$_fid) {
    	$html = '';
		if (isset($_lm)) {
			$js_array = '[';
			foreach ($_lm as $lmk => $lmv) {
				$ago =Job::formatTimeAgo(Job::humanTiming($lmv['created_at']));
				$js_array .= ',{
								"msg":"'.$lmv['message'].'",
								"ago":"'.$ago.'",
								"sdr":"'.$lmv['user_id'].'"
							}';
			}
			$js_array .= ']';
			$html .= '	<script>
						window.cdata_'.$_tu.'_'.$_fid.' = '.$js_array.';
						</script>';
		}

		return $html;
    }










}
