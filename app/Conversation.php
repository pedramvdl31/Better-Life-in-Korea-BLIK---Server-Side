<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'convs';



    static public function PrepareFewForChat($convs) {
    	$html = '';
    	if(isset($convs)) {
    		Conversation::Prepar();
    	}

    	return $html;
    }
    static private function Prepar() {
    	$html = '';
    	if(isset($convs)) {
    		
    	}

    	return $html;
    }
}