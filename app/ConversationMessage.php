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


    static public function PrepareChatHtml($relations,$convs) {

    	$html = '';
    	if(isset($convs,$relations)) {
    		$t_user = Auth::user()->id;
    		$friend_id = null;
    		//find friend id
    		foreach ($relations as $fk => $fv) {
    			if ($fv['user_one'] == $t_user) {
    				$friend_id = $fv['user_two'];
    			} else {
    				$friend_id = $fv['user_one'];
    			}
	    		//get last 10 messages
	    		if (isset($friend_id)) {
	    			$html .= ConversationMessage::fd($friend_id);
	    			foreach ($convs as $ck => $cv) {
	    				if ($cv['user_one'] == $friend_id || $cv['user_two'] == $friend_id) {
	    					//get last messages
	    					$last_messages = ConversationMessage::where('conv_id',$cv['id'])
	    					->take(6)->get();
	    					$html .= ConversationMessage::mks($last_messages,$t_user,$friend_id);
	    				}
	    			}
	    		}
    		}
    	}
    	return $html;
    }
    static private function mks($_lm,$_tu,$_fid) {
    	$html = '';
		if (isset($_lm)) {
			$js_array = '[';
			foreach ($_lm as $lmk => $lmv) {
				$ago =Job::formatTimeAgo(Job::humanTiming($lmv['created_at']));
				$js_array .= ',{"msg":"'.$lmv['message'].'", "ago":"'.$ago.'"}';
			}
			$js_array .= ']';
			$html .= '	<script>
						cdata_'.$_tu.'_'.$_fid.' = '.$js_array.';
						</script>';
		}
		return $html;
    }
    static private function fd($fid) {
    	$html = '';
	    $fd = User::find($fid);
    	if (isset($fd)) {
    		$new_email = strlen($fd->email) > 15 ? substr($fd->email,0,15)."..." : $fd->email;
    		$ntt = strlen($fd->email) > 15 ? true : false;
    		$html .= '<div class="conv-wrapper pointer"';
    		if ($ntt==true) {
    		 	$html .= 'data-toggle="tooltip" data-placement="top" title="'.$fd->email.'"';
    		 }
    		//this is right
    		$html .= '>
							<i class="lfloat _4xia img sp_BNtOXyg0vlE sx_78fc23"></i>
						    <img src="/assets/images/home/product4.jpg" alt="" />
						    <span>'.$new_email.'</span>
						    <span class="label label-success conv-c">2</span>
						</div>';
		}
		return $html;
    }







}
