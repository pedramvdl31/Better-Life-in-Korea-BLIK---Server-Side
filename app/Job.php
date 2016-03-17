<?php

namespace App;

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
use Mail;




use Illuminate\Database\Eloquent\Model;

class Job extends Model
{



	static public function ViewShareAdminPrivateData() {
		$array = [];
		$this_username = null;
        $this_user_profile_image = null;
        if (Auth::check()) {
            $this_user = User::find(Auth::user()->id);
            $this_username = $this_user->username;
            $this_user_profile_image = Job::imageValidator($this_user->profile_image);
        } 
        View::share('this_username',$this_username);
        View::share('this_user_profile_image',$this_user_profile_image);
		return $array;
	}
	static public function ViewSharesPublicData() {
		$data = [];
        $data['website_brand'] = WebsiteBrand::CheckDataAndReturn();
        view::share('website_brand',$data['website_brand']);
		return 0;
	}



	static public function dump($results) {
		if(isset($results)) {
			echo '<pre>';
			print_r($results);
			echo '</pre>';
		}

		return false;
	}
	static public function d($results) {
		if(isset($results)) {
			echo '<pre>';
			print_r($results);
			echo '</pre>';
		}

		return false;
	}
	static public function UrlFriendly($string) {
		if(isset($string)) {
			return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
		} else {
			return null;
		}
	}

	static public function IsThisUser($id) {
		$output = false;
		if(Auth::check()) {
			if (isset($id)) {
				if (Auth::user()->id == $id) {
					$output = true;
				}
			}
		}
		return $output;
	}

	static public function prepareNotifications() {
		$notif = [];
		$notif['isset']=false;
		$notif['count']=false;
		$all_t_count = 0;
		

		return $notif;
	}

	static public function GetPercentage($percentage,$total) {
		$new_p = ( $percentage / 100 ) * $total;
		return $new_p;
	}

	static public function MakePhoneFormat($phone_number) {
		$output = '';
		if (isset($phone_number)) {
	        $split1 = substr($phone_number,0,3); 
	        $split2 = substr($phone_number,3,4); 
	        $split3 = substr($phone_number,7,4);
	        $output =  $split1.'-'.$split2.'-'.$split3;
		}
		return $output;
	}



	static public function IdToUsername($id) {
		$username = '';
		if(isset($id)) {
			$users = User::find($id);
			$username = $users->username.' ('.$id.')';
		}
		return $username;
	}





	static public function OnlyNumberFilter($data) {
		if(isset($data)) {
			$data = str_replace(array(','), '' , $data);
		}
		return $data;
	}


	static public function FilterSpecialCharacters($data) {

		$output = '';
		if (isset($data)) {
   			$output = str_replace(' ', '%-%', $data); 
			$whiteSpace = '\s';
			$pattern = '/[^A-Za-z0-9\%-%--]/';
			$output = preg_replace($pattern, '', (string) $output);
			$output = str_replace('%-%', ' ', $output);
		}
		return $output;
	}

	static public function CheckEmptySet($data) {
		$output = false;
		if (isset($data)) {
			if (!empty($data)) {
				if ($data != '') {
					$output = true;
				}
				
			}
		}
		return $output;
	}

	static public function IsEmpty($data) {
		$output = true;
		if (isset($data)) {
			if (!empty($data)) {
				if ($data != '') {
					$output = false;
				}
				
			}
		}
		return $output;
	}
	public static function country_code(){
	    return array
	    (
	        'AF' => 'Afghanistan',
	        'AX' => 'Aland Islands',
	        'AL' => 'Albania',
	        'DZ' => 'Algeria',
	        'AS' => 'American Samoa',
	        'AD' => 'Andorra',
	        'AO' => 'Angola',
	        'AI' => 'Anguilla',
	        'AQ' => 'Antarctica',
	        'AG' => 'Antigua And Barbuda',
	        'AR' => 'Argentina',
	        'AM' => 'Armenia',
	        'AW' => 'Aruba',
	        'AU' => 'Australia',
	        'AT' => 'Austria',
	        'AZ' => 'Azerbaijan',
	        'BS' => 'Bahamas',
	        'BH' => 'Bahrain',
	        'BD' => 'Bangladesh',
	        'BB' => 'Barbados',
	        'BY' => 'Belarus',
	        'BE' => 'Belgium',
	        'BZ' => 'Belize',
	        'BJ' => 'Benin',
	        'BM' => 'Bermuda',
	        'BT' => 'Bhutan',
	        'BO' => 'Bolivia',
	        'BA' => 'Bosnia And Herzegovina',
	        'BW' => 'Botswana',
	        'BV' => 'Bouvet Island',
	        'BR' => 'Brazil',
	        'IO' => 'British Indian Ocean Territory',
	        'BN' => 'Brunei Darussalam',
	        'BG' => 'Bulgaria',
	        'BF' => 'Burkina Faso',
	        'BI' => 'Burundi',
	        'KH' => 'Cambodia',
	        'CM' => 'Cameroon',
	        'CA' => 'Canada',
	        'CV' => 'Cape Verde',
	        'KY' => 'Cayman Islands',
	        'CF' => 'Central African Republic',
	        'TD' => 'Chad',
	        'CL' => 'Chile',
	        'CN' => 'China',
	        'CX' => 'Christmas Island',
	        'CC' => 'Cocos (Keeling) Islands',
	        'CO' => 'Colombia',
	        'KM' => 'Comoros',
	        'CG' => 'Congo',
	        'CD' => 'Congo, Democratic Republic',
	        'CK' => 'Cook Islands',
	        'CR' => 'Costa Rica',
	        'CI' => 'Cote D\'Ivoire',
	        'HR' => 'Croatia',
	        'CU' => 'Cuba',
	        'CY' => 'Cyprus',
	        'CZ' => 'Czech Republic',
	        'DK' => 'Denmark',
	        'DJ' => 'Djibouti',
	        'DM' => 'Dominica',
	        'DO' => 'Dominican Republic',
	        'EC' => 'Ecuador',
	        'EG' => 'Egypt',
	        'SV' => 'El Salvador',
	        'GQ' => 'Equatorial Guinea',
	        'ER' => 'Eritrea',
	        'EE' => 'Estonia',
	        'ET' => 'Ethiopia',
	        'FK' => 'Falkland Islands (Malvinas)',
	        'FO' => 'Faroe Islands',
	        'FJ' => 'Fiji',
	        'FI' => 'Finland',
	        'FR' => 'France',
	        'GF' => 'French Guiana',
	        'PF' => 'French Polynesia',
	        'TF' => 'French Southern Territories',
	        'GA' => 'Gabon',
	        'GM' => 'Gambia',
	        'GE' => 'Georgia',
	        'DE' => 'Germany',
	        'GH' => 'Ghana',
	        'GI' => 'Gibraltar',
	        'GR' => 'Greece',
	        'GL' => 'Greenland',
	        'GD' => 'Grenada',
	        'GP' => 'Guadeloupe',
	        'GU' => 'Guam',
	        'GT' => 'Guatemala',
	        'GG' => 'Guernsey',
	        'GN' => 'Guinea',
	        'GW' => 'Guinea-Bissau',
	        'GY' => 'Guyana',
	        'HT' => 'Haiti',
	        'HM' => 'Heard Island & Mcdonald Islands',
	        'VA' => 'Holy See (Vatican City State)',
	        'HN' => 'Honduras',
	        'HK' => 'Hong Kong',
	        'HU' => 'Hungary',
	        'IS' => 'Iceland',
	        'IN' => 'India',
	        'ID' => 'Indonesia',
	        'IR' => 'Iran, Islamic Republic Of',
	        'IQ' => 'Iraq',
	        'IE' => 'Ireland',
	        'IM' => 'Isle Of Man',
	        'IL' => 'Israel',
	        'IT' => 'Italy',
	        'JM' => 'Jamaica',
	        'JP' => 'Japan',
	        'JE' => 'Jersey',
	        'JO' => 'Jordan',
	        'KZ' => 'Kazakhstan',
	        'KE' => 'Kenya',
	        'KI' => 'Kiribati',
	        'KR' => 'Korea (South)',
	        'KW' => 'Kuwait',
	        'KG' => 'Kyrgyzstan',
	        'LA' => 'Lao People\'s Democratic Republic',
	        'LV' => 'Latvia',
	        'LB' => 'Lebanon',
	        'LS' => 'Lesotho',
	        'LR' => 'Liberia',
	        'LY' => 'Libyan Arab Jamahiriya',
	        'LI' => 'Liechtenstein',
	        'LT' => 'Lithuania',
	        'LU' => 'Luxembourg',
	        'MO' => 'Macao',
	        'MK' => 'Macedonia',
	        'MG' => 'Madagascar',
	        'MW' => 'Malawi',
	        'MY' => 'Malaysia',
	        'MV' => 'Maldives',
	        'ML' => 'Mali',
	        'MT' => 'Malta',
	        'MH' => 'Marshall Islands',
	        'MQ' => 'Martinique',
	        'MR' => 'Mauritania',
	        'MU' => 'Mauritius',
	        'YT' => 'Mayotte',
	        'MX' => 'Mexico',
	        'FM' => 'Micronesia, Federated States Of',
	        'MD' => 'Moldova',
	        'MC' => 'Monaco',
	        'MN' => 'Mongolia',
	        'ME' => 'Montenegro',
	        'MS' => 'Montserrat',
	        'MA' => 'Morocco',
	        'MZ' => 'Mozambique',
	        'MM' => 'Myanmar',
	        'NA' => 'Namibia',
	        'NR' => 'Nauru',
	        'NP' => 'Nepal',
	        'NL' => 'Netherlands',
	        'AN' => 'Netherlands Antilles',
	        'NC' => 'New Caledonia',
	        'NZ' => 'New Zealand',
	        'NI' => 'Nicaragua',
	        'NE' => 'Niger',
	        'NG' => 'Nigeria',
	        'NU' => 'Niue',
	        'NF' => 'Norfolk Island',
	        'MP' => 'Northern Mariana Islands',
	        'NO' => 'Norway',
	        'OM' => 'Oman',
	        'PK' => 'Pakistan',
	        'PW' => 'Palau',
	        'PS' => 'Palestinian Territory, Occupied',
	        'PA' => 'Panama',
	        'PG' => 'Papua New Guinea',
	        'PY' => 'Paraguay',
	        'PE' => 'Peru',
	        'PH' => 'Philippines',
	        'PN' => 'Pitcairn',
	        'PL' => 'Poland',
	        'PT' => 'Portugal',
	        'PR' => 'Puerto Rico',
	        'QA' => 'Qatar',
	        'RE' => 'Reunion',
	        'RO' => 'Romania',
	        'RU' => 'Russian Federation',
	        'RW' => 'Rwanda',
	        'BL' => 'Saint Barthelemy',
	        'SH' => 'Saint Helena',
	        'KN' => 'Saint Kitts And Nevis',
	        'LC' => 'Saint Lucia',
	        'MF' => 'Saint Martin',
	        'PM' => 'Saint Pierre And Miquelon',
	        'VC' => 'Saint Vincent And Grenadines',
	        'WS' => 'Samoa',
	        'SM' => 'San Marino',
	        'ST' => 'Sao Tome And Principe',
	        'SA' => 'Saudi Arabia',
	        'SN' => 'Senegal',
	        'RS' => 'Serbia',
	        'SC' => 'Seychelles',
	        'SL' => 'Sierra Leone',
	        'SG' => 'Singapore',
	        'SK' => 'Slovakia',
	        'SI' => 'Slovenia',
	        'SB' => 'Solomon Islands',
	        'SO' => 'Somalia',
	        'ZA' => 'South Africa',
	        'GS' => 'South Georgia And Sandwich Isl.',
	        'ES' => 'Spain',
	        'LK' => 'Sri Lanka',
	        'SD' => 'Sudan',
	        'SR' => 'Suriname',
	        'SJ' => 'Svalbard And Jan Mayen',
	        'SZ' => 'Swaziland',
	        'SE' => 'Sweden',
	        'CH' => 'Switzerland',
	        'SY' => 'Syrian Arab Republic',
	        'TW' => 'Taiwan',
	        'TJ' => 'Tajikistan',
	        'TZ' => 'Tanzania',
	        'TH' => 'Thailand',
	        'TL' => 'Timor-Leste',
	        'TG' => 'Togo',
	        'TK' => 'Tokelau',
	        'TO' => 'Tonga',
	        'TT' => 'Trinidad And Tobago',
	        'TN' => 'Tunisia',
	        'TR' => 'Turkey',
	        'TM' => 'Turkmenistan',
	        'TC' => 'Turks And Caicos Islands',
	        'TV' => 'Tuvalu',
	        'UG' => 'Uganda',
	        'UA' => 'Ukraine',
	        'AE' => 'United Arab Emirates',
	        'GB' => 'United Kingdom',
	        'US' => 'United States',
	        'UM' => 'United States Outlying Islands',
	        'UY' => 'Uruguay',
	        'UZ' => 'Uzbekistan',
	        'VU' => 'Vanuatu',
	        'VE' => 'Venezuela',
	        'VN' => 'Viet Nam',
	        'VG' => 'Virgin Islands, British',
	        'VI' => 'Virgin Islands, U.S.',
	        'WF' => 'Wallis And Futuna',
	        'EH' => 'Western Sahara',
	        'YE' => 'Yemen',
	        'ZM' => 'Zambia',
	        'ZW' => 'Zimbabwe',
	        );      
}
	static public function validate_data($input_all) {
		$data_output = [
		'message' => '',
		'status' => 400,
		'validator' => ''
		];
		if (isset($input_all)) {
			foreach ($input_all as $type => $value) {
				switch ($type) {
					case 'email':
						$count = count(User::where('email',$value)->first());
						if ($count == 0) {
							if (filter_var($input_all[$type], FILTER_VALIDATE_EMAIL)) {
								$data_output[$type]['status'] = 200;

							} else {
								$data_output[$type]['message']  = 'Invalid Format';
								$data_output[$type]['status'] = 400;
							}
						} else {
								$data_output[$type]['message']  = 'Email Already Registered';
								$data_output[$type]['status'] = 400;
						}

					break;
					case 'password':
				         $valid = 1;
				         if (strlen($input_all[$type]) <= '5') {
				             $data_output[$type]['message'] = "Must Contain At Least 6 Characters";
				        	$data_output[$type]['status'] = 400;
				         }
				         elseif(!preg_match("#[0-9]+#",$input_all[$type])) {
				             $data_output[$type]['message'] = "Must Contain At Least 1 Number";
				        	$data_output[$type]['status'] = 400;
				         }
				         else {
				             $data_output[$type]['status'] = 200;
				         }
			        break;
			        case 'password_again':
				         $valid = 1;
				         if ($input_all[$type] != $input_all["password"]) {
				        	$data_output[$type]['message'] = "Entered Passwords Does Not Match";
				         	$data_output[$type]['status'] = 400;
				         }
				         elseif(strlen($input_all[$type]) <= '5') {
				            $data_output[$type]['message'] = "Must Contain At Least 6 Characters";
				        	$data_output[$type]['status'] = 400;
				         }
				         else {
				             $data_output[$type]['status'] = 200;
				         }
			        break;
					default:
					break;
				}
			}
		}
		return $data_output;
	}



	static public function swear_keywords() {
		$filter_array_s = array(
			'anal','anus','arse','ass','ballsack','balls','bastard',
			'bitch','biatch','bloody','blowjob','blow job','bollock',
			'bollok','boner','boob','bugger','bum','butt','buttplug',
			'clitoris','cock','coon','crap','cunt','damn','dick','dildo',
			'dyke','fag','feck','fellate','fellatio','felching','fuck',
			'f u c k','fudgepacker','fudge packer','fucking','flange','Goddamn',
			'God damn','hell','homo','jerk','jizz','knobend','knob end','labia',
			'lmao','lmfao','muffnigger','omg','penis','piss','poop','prick',
			'pube','pussy','queerscrotum','shit','s hit','sh1t','slut','smegma',
			'spunk','tit','tosser','turd','twat','vagina','wank','whore','wtf'
			);
		return $filter_array_s;
	}

	static public function pronouns_keywords() {
		$filter_array_p = array(
			"hello","hi","all","another","any","anybody","anyone","anything","both
			","each","each other","either everybody","everything
			","her","with","hers","herself","him","himself","it","It","its","itself","little
			","many","me","mine","more","most","much","my","myself","neither 
			","no one","nobody","none","nothing","one","one another 
			","other","others","our","ours","ourselves","several","she 
			","some","somebody","someone","something","that","their","theirs 
			","them","themselves","these","they","this","those","we","what 
			","whatever","which","whichever","who","whoever","whom","whomever
			","whose","you","your","yours","yourself","yourselves","i","I","you",
			"You","we","We","he","He","she","She","have","has","am","to","a","an",
			"i'm","you'r","he's","she's","it's","guys","guy's"
			);
		return $filter_array_p;
	}

	static public function alphabet_keywords() {
		$filter_array_a = array(
		'a','b','c','d','e','f','g','h','i','j','k','l',
		'm','n','o','p','q','r','s','t','u','v','w','x','y','z'
		);
		return $filter_array_a;
	}

	static public function numeric_keywords() {
		$filter_array_n = array(
			'1','2','3','4','5','6','7','8','9','10'
			);
		return $filter_array_n;
	}


	static public function cleanInput($input) {
	  $search = array(
	    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
	    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
	    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
	    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
	  );
	 
	    $output = preg_replace($search, '', $input);
	    return $output;
	}

	static public function sanitize($input) {

	    if (is_array($input)) {
	        foreach($input as $var=>$val) {
	            $output[$var] = Job::sanitize($val);
	        }
	    }
	    else {
	        if (get_magic_quotes_gpc()) {
	            $input = stripslashes($input);
	        }
	        $output  = Job::cleanInput($input);
	    }
	    return $output;

	}

	static public function trime_filter($input) {
		$output = null;
		
		$output_string =  array('array' => '', 'string'=>'');
		//FORMATING
		$search_str_formated =  preg_replace("/[^a-zA-Z0-9]+/", " ", $input);
		$trimmed = trim($search_str_formated);
		$str_lowered = strtolower($trimmed);
		$search_str_formated = explode(" ",$str_lowered);



		//FILTERING
		$swear_filtered = array_diff($search_str_formated, Job::swear_keywords());
		$pronouns_filtered = array_diff($swear_filtered, Job::pronouns_keywords());
		$alphabet_filtered = array_diff($pronouns_filtered, Job::alphabet_keywords());
		$numeric_filtered = array_values(array_diff($alphabet_filtered, Job::numeric_keywords()));
		$output = $numeric_filtered;

		$output_string['array'] = $numeric_filtered;
		//Connect the string back togather 
		foreach ($output as $opkey => $opvalue) {
			$output_string['string'] .= $opvalue.' ';
		}


		return $output_string;

	}

	static public function imageValidator($image_path) {
		$full_path = public_path("/assets/images/profile-images/perm/".$image_path);
		if (!file_exists($full_path)) {
		    $image_path = "blank_male.png";
		}
		return $image_path;
	}

	static public function humanTiming($time)
	{
		// Job::dump($time);
		$time=strtotime($time);
	    $time = time() - $time; // to get the time since that moment
	    $tokens = array (
	        31536000 => 'year',
	        2592000 => 'month',
	        604800 => 'week',
	        86400 => 'day',
	        3600 => 'hour',
	        60 => 'minute',
	        1 => 'second'
	    );

	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
	    }

	}
	
	static public function formatTimeAgo($human_time_data) {
		if ($human_time_data == null) {
			$human_time_data = 'just now';
		} else {
			$human_time_data = $human_time_data.' ago';
		}
		return $human_time_data;
	}

	static public function replaceLongTextWithElipses($limit, $string, $repl) {
		if(strlen($string) > $limit) {
			return substr($string, 0, $limit) . $repl; 
		} else {
			return $string;
		}
	}

    static public function StatesOfKoreaForSelect() {
		return [
			''	=> 'Select a State',
			'1' => '광역시도',
			'2' => '강원도',
			'3' => '경기도',
			'4' => '경상남도',
			'5' => '경상북도',
			'6' => '광주광역시',
			'7' => '대구광역시',
			'8' => '대전광역시',
			'9' => '부산광역시',
			'10' => '서울특별시',
			'11' => '세종특별자치시',
			'12' => '울산광역시',
			'13' => '인천광역시',
			'14' => '전라남도',
			'15' => '전라북도',
			'16' => '제주특별자치도',
			'17' => '충청남도',
			'18' => '충청북도'		
		];
	}
    static public function generateRandomString($length) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	
	static public function VerificationMailer($email,$url) {
        $status = 400;
        if (Mail::send('emails.verify_email', array(
                    'email' => $email,
                    'url' => $url
                ), function($message) use ($email,$url)
                {
                    $message->from('postmaster@webprinciples.com');
                    $message->to($email);
                    $message->subject('Verify Your Email Address');
                })) {
            $status = 200;
        }
        return $status;
	}

	public static function cat_select() {
            return array(
                '0'         => 'Select Category',
                '1'        	=> 'Real Estate',
                '2'        	=> 'Restaurant',
                '3'     	=> 'Used Car',
                '4'  		=> 'Moving In/Out',
                '5'     	=> 'Flea Market',
                '6'      	=> 'Events',
                '7'      	=> 'Fun',
                );
        }

	public static function perpare_subcat($cat_id) {
		$tarray = null;
		switch ($cat_id) {
			case '1':
				$tarray =	array(
			                '0'      => 'Select SubCategory',
			                '1'      => 'Agencies',
			                '2'      => 'Private',
			                );
				break;
			case '2':
				$tarray =	array(
			                '0'      => 'Select SubCategory',
			                '1'      => 'Asian',
			                '2'      => 'Italian',
			                '3'      => 'Western',
			                '4'      => 'Mexican',
			                '5'      => 'Other',
			                );
				break;
			case '3':
				$tarray =	array(
			                '0'      => 'Select SubCategory',
			                '1'      => 'Agencies',
			                '2'      => 'Private',
			                '3'      => 'Sofa Document Fee'
			                );
				break;
			case '4':
				$tarray =	array(
			                '0'      => 'Select SubCategory',
			                '1'      => 'Cleaning',
			                '2'      => 'Services',
			                '3'      => 'Moving Company',
			                '4'      => 'CellPhone',
			                );
				break;
			case '5':
				$tarray =	array(
			                '0'      => 'Select SubCategory',
			                '1'      => 'Agencies',
			                '2'      => 'Private',
			                );
				break;
			case '6':
				$tarray =	array(
			                '0'      => 'Select SubCategory',
			                '1'      => 'Agencies',
			                '2'      => 'Private',
			                );
				break;
			
			default:
				$tarray =	array(
			                '0'          => 'Select SubCategory',
			                );
				break;
		}
            return $tarray; 
        }
    public static function korean_cities(){
		return $html =	'<option value="0">Seoul</option><option value="1">Incheon</option><option value="2">Paju</option><option value="3">Cheonan</option><option value="4">Yongin</option><option value="5">Kwanghui-dong</option><option value="6">Pon-dong</option><option value="7">Gwangju</option><option value="8">Gwangmyeong</option><option value="9">Tang-ni</option><option value="10">Busan</option><option value="11">Seongnam-si</option><option value="12">Suwon-si</option><option value="13">Namyang</option><option value="14">Namyangju</option><option value="15">Jeju-si</option><option value="16">Ulsan</option><option value="17">Osan</option><option value="18">Hanam</option><option value="19">Pyong-gol</option><option value="20">Anyang-si</option><option value="21">Yangsan</option><option value="22">Daejeon</option><option value="23">Nonsan</option><option value="24">Seocho</option><option value="25">Wonju</option><option value="26">Kisa</option><option value="27">Daegu</option><option value="28">Ansan-si</option><option value="29">Gongju</option><option value="30">Haeundae</option><option value="31">Sasang</option><option value="32">Bucheon-si</option><option value="33">Chuncheon</option><option value="34">Ilsan-dong</option><option value="35">Naju</option><option value="36">Jinju</option><option value="37">Uiwang</option><option value="38">Gangneung</option><option value="39">Yongsan-dong</option><option value="40">Pohang</option><option value="41">Changwon</option><option value="42">Jeonju</option><option value="43">Yeosu</option><option value="44">Songnim</option><option value="45">Gimhae</option><option value="46">Songjeong</option><option value="47">Hyoja-dong</option><option value="48">Icheon-si</option><option value="49">Kimso</option><option value="50">Iksan</option><option value="51">Deokjin</option><option value="52">Koyang-dong</option><option value="53">Samsung</option><option value="54">Anseong</option><option value="55">Samjung-ni</option><option value="56">Mapo-dong</option><option value="57">Gunnae</option><option value="58">Nae-ri</option><option value="59">Suncheon</option><option value="60">Okpo-dong</option><option value="61">Moppo</option><option value="62">Sangdo-dong</option><option value="63">Cheongju-si</option><option value="64">Chaeun</option><option value="65">Taebuk</option><option value="66">Yeoju</option><option value="67">Seong-dong</option><option value="68">Duchon</option><option value="69">Gyeongju</option><option value="70">Andong</option><option value="71">Seosan City</option><option value="72">Asan</option><option value="73">Miryang</option><option value="74">Wonmi-gu</option><option value="75">Janghowon</option><option value="76">Chungnim</option><option value="77">Songam</option><option value="78">Tongan</option><option value="79">Apo</option><option value="80">Jecheon</option><option value="81">Se-ri</option><option value="82">Ka-ri</option><option value="83">Hansol</option><option value="84">Songang</option><option value="85">Hyangyang</option><option value="86">Gyeongsan-si</option><option value="87">Gumi</option><option value="88">Unpo</option><option value="89">Ulchin</option><option value="90">Namhyang-dong</option><option value="91">Taebaek</option><option value="92">Hadong</option><option value="93">Haesan</option><option value="94">Chungju</option><option value="95">Chilgok</option><option value="96"></option>';
    }
}
