<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Job;
use App\Ad;

class Wishlist extends Model
{
    static public function PrepareForHome($data) {
    	$html = '';
    	if (isset($data)) {
    		$html .= '  <div class="table-responsive">
						<table class="table table-striped"> 
						<thead> 
						<tr> 
						<th>Title</th> 
						<th>Action</th> 
						</tr> 
						</thead> 
						<tbody> ';
    		foreach ($data as $dk => $dv) {
    			$ads = Ad::find($dv['ad_id']);
    			if (isset($ads)) {
    				if (isset($ads['title'])) {
	                    $t_temp = $ads['title'];
	                    $new_t = strlen($t_temp)>25?substr($t_temp,0,15)."...":$t_temp;
	                }
					$html .= '	<tr> 
	            				<th scope="row">'.$new_t.'</th> 
	            				<td>
	            					<a class="pointer view-ad-wl" data="'.$ads->id.'">View</a>&nbsp/&nbsp<a class="pointer remove-ad-wl" data="'.$ads->id.'">Remove</a>
	            				</td> 
	                			</tr> ';
    			}

    		}
    		$html .= '	</tbody> 
	                	</table>      	
                		</div>';
    	}
        return $html;
    }
}
