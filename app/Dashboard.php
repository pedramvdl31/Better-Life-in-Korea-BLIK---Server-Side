<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    
    static public function PrepareAllPosts($data) {
    	if(isset($data)) {
    		foreach ($data as $key => $value) {
				if(isset($value['created_at'])) {
					$data[$key]['date_html'] = date ( 'n/d/Y g:ia',  strtotime($value['created_at']) );
				}
    		}
    	}
    	return $data;
    }




}
