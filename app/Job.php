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


	static public function distance($lat1, $lon1, $lat2, $lon2, $unit, $decimal) {
	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);

	  if ($unit == "K") {
	  	return ( number_format(($miles * 1.609344), $decimal, '.', ''));
	  } else if ($unit == "M") {
	    	return (number_format(($miles * 1609.34), $decimal, '.', ''));
	    } 	else {
	        	return $miles;
	      	}
	}

	static public function ReturnBp() {
        $bp = 'https://www.betterlifeinkorea.com';
        // $bp = 'http://kora.app:8000';
		return $bp;
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
	        31536000 => 'year ago',
	        2592000 => 'month ago',
	        604800 => 'week ago',
	        86400 => 'day ago',
	        3600 => 'hour ago',
	        60 => 'minute ago',
	        1 => 'second ago'
	    );
	    if ($time<=60) {
	    	return 'a few seconds';
	    } else {
		    foreach ($tokens as $unit => $text) {
		        if ($time < $unit) continue;
		        $numberOfUnits = floor($time / $unit);
		        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		    }	    	
	    }
	}
	
	static public function formatTimeAgo($human_time_data) {
		if ($human_time_data == null) {
			$human_time_data = 'just now';
		} else {
			$human_time_data = $human_time_data;
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
                '1'        	=> 'Lodging',
                '2'     	=> 'Restaurant',
                '3'        	=> 'Real Estate',
                '4'  		=> 'Moving In/Out',
                '5'     	=> 'Used Car',
                '6'      	=> 'Events',
                '7'     	=> 'Flea Market',
                '8'      	=> 'Fun',
                );
        }

	public static function prov_select() {
            return array(
                '0'         => 'Select City',
                '1'      	=> 'Gangwon-Do',
                '2'        	=> 'Gyeonggi-Do',
                '3'        	=> 'Seoul',
                '4'     	=> 'Incheon',
                '5'      	=> 'Daejeon',
                '6'     	=> 'Chungcheong-Bukdo',
                '7'      	=> 'Ullung-Do',
                '8'     	=> 'Gyeongsang-Bukdo',
                '9'      	=> 'Ulsan',
                '10'      	=> 'Gyeongsang-Namdo',
                '11'      	=> 'Busan',
                '12'      	=> 'Daegu',
                '13'     	=> 'Gwangju',
                '14'      	=> 'Jeolla-Bukdo',
                '15'  		=> 'Chungcheong-Namdo',
                '16'      	=> 'Jeollanam-Do',
                '17'      	=> 'Jeju-Do'
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
			                '1'      => 'Hotel',
			                '2'      => 'Motel',
			                '3'      => 'Traditional House',
			                '4'      => 'Guest House'
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
			                '3'      => 'Sofa Document Fee'
			                );
				break;
			case '6':
				$tarray =	array(
			                '0'      => 'Select SubCategory',
			                '1'      => 'Agencies',
			                '2'      => 'Private',
			                );
				break;
			case '7':
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
		return $html =	'	<option value="1">Pyeongtaek downtown</option>
							<option value="2">Incheon</option>
							<option value="3">Dongchangri</option>
							<option value="4">Chunan</option>
							<option value="5">Songtan</option>';
    }
    public static function korean_cities_search(){
		return $html =	'
							<option value="">Search by City</option>
							<option value="1">Pyeongtaek downtown</option>
							<option value="2">Incheon</option>
							<option value="3">Dongchangri</option>
							<option value="4">Chunan</option>
							<option value="5">Songtan</option>;

		';
    }
    
    public static function obfuscate_email($email)
	{
	    $em   = explode("@",$email);
	    $name = implode(array_slice($em, 0, count($em)-1), '@');
	    $len  = floor(strlen($name)/2);

	    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
	}
}
