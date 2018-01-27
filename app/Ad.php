<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Wishlist;
use App\Review;
use Request;
use DB;
use App\Comment;
class Ad extends Model
{
    
    public static $rules_edit = array(
        'cat'=>'required',
        'title'=>'required',
        'description'=>'required'
    );
    static public function PrepareAdsSearchTxt($txtd) {
        $output = null;
        if (isset($txtd)) {
            $ad_array = array();
            $ad = Ad::where('status',1)->get();
            // all ads
            foreach ($ad as $k => $v) {
                $t = explode(' ',$v->title);
                // ad title exploded by space
                foreach ($t as $tk => $tv) {
                    if ($txtd == $tv) {
                        array_push($ad_array, $v->id);
                    }
                }
            }
            $ads = Ad::where('status',1)->whereIn('id', $ad_array)
                ->paginate(8);
            if (isset($ads)) {
                $output = Ad::PrepareAdsForHome($ads);
            }
        }
        return $output;
    }
    static public function PrepareAdsSearchCategory($cat_id,$cit) {
        $output = null;
        if ($cit==0||$cit=='0') {
            $ads = Ad::where('status',1)->where('cat_id',$cat_id)->orderBy('id', 'desc')->take(8)->get();
        } else {
            $ads = Ad::where('status',1)->where('cat_id',$cat_id)->where('city',$cit)->orderBy('id', 'desc')->take(8)->get();
        }
        
        if (isset($ads)) {
            $output = Ad::PrepareAdsForHome($ads);
        }
        return $output;
    }
    static public function PrepareAdsSearchCategoryApi($cat_id,$cit) {
        $output = null;
        if ($cit==0||$cit=='0') {
            $ads = Ad::where('status',1)->where('cat_id',$cat_id)->orderBy('id', 'desc')->take(8)->get();
        } else {
            $ads = Ad::where('status',1)->where('cat_id',$cat_id)->where('city',$cit)->orderBy('id', 'desc')->take(8)->get();
        }
        
        if (isset($ads)) {
            $output = Ad::PrepareAdsForHomeApi($ads);
        }
        return $output;
    }
    static public function PrepareAdsSearchCategoryApiLoc($cat_id,$lat,$lng,$radius) {
        $output = null;
        if ($lat==0||$lat=='0'||$lng==0||$lng=='0') {
            $ads = Ad::where('status',1)->where('cat_id',$cat_id)->orderBy('id', 'desc')->take(8)->get();
        } else {
            $ads = Ad::select(
                 \DB::raw("*,
                ( 3959 * acos( cos( radians(" . $lat . ") ) *
                cos( radians( lat ) )
                * cos( radians( lng ) - radians(" . $lng . ")
                ) + sin( radians(" . $lat . ") ) *
                sin( radians( lat ) ) )
                ) AS distance"))
                ->having("distance", "<", $radius)
                ->orderBy("distance")
                ->where('cat_id',$cat_id)
                ->take(8)
                ->get();
        }
        
        if (isset($ads)) {
            $output = Ad::PrepareAdsForHomeApi($ads);
        }
        return $output;
    }
    static public function PrepareAdsMap($cat_id,$lat,$lng,$radius) {
        $output = null;
        if ($lat==0||$lat=='0'||$lng==0||$lng=='0') {
            $ads = Ad::where('status',1)->where('cat_id',$cat_id)->orderBy('id', 'desc')->get();
        } else {
            $ads = Ad::select(
                 \DB::raw("*,
                ( 3959 * acos( cos( radians(" . $lat . ") ) *
                cos( radians( lat ) )
                * cos( radians( lng ) - radians(" . $lng . ")
                ) + sin( radians(" . $lat . ") ) *
                sin( radians( lat ) ) )
                ) AS distance"))
                ->having("distance", "<", $radius)
                ->orderBy("distance")
                ->where('cat_id',$cat_id)
                ->get();
        }
        if (isset($ads)) {
            $output = Ad::PrepareAdsForMap($ads,$lat,$lng);
        }
        return $output;
    }
    static public function PrepareAdsMapAjax($take_ad,$skip_ad,$lat,$lng,$cat) {
        Job::dump('here');
        $output = null;
        if (!isset($lat,$lng)||empty($lat)&&empty($lng)) {
            $ads = Ad::where('status',1)->orderBy('id', 'desc')->skip($skip_ad)->take($take_ad)->get();
        } else {
            if ($cat != 0) {
                $ads = Ad::select(
                 \DB::raw("*,
                ( 3959 * acos( cos( radians(" . $lat . ") ) *
                cos( radians( lat ) )
                * cos( radians( lng ) - radians(" . $lng . ")
                ) + sin( radians(" . $lat . ") ) *
                sin( radians( lat ) ) )
                ) AS distance"))
                ->orderBy("distance")
                ->skip($skip_ad)
                ->take($take_ad)
                ->where('cat_id',$cat)
                ->get(); 
                
            } else {
                $ads = Ad::select(
                     \DB::raw("*,
                    ( 3959 * acos( cos( radians(" . $lat . ") ) *
                    cos( radians( lat ) )
                    * cos( radians( lng ) - radians(" . $lng . ")
                    ) + sin( radians(" . $lat . ") ) *
                    sin( radians( lat ) ) )
                    ) AS distance"))
                    ->orderBy("distance")
                    ->skip($skip_ad)
                    ->take($take_ad)
                    ->get();   
            }
        }
        if (isset($ads)) {
            $output = Ad::PrepareAdsForMapAjax($ads,$lat,$lng);
        }
        return $output;
    }
    static public function PrepareAdsMapAjaxProfile($take_ad,$skip_ad,$tkn,$lat,$lng) {
        $output = null;
        if (isset($tkn)) {
            $this_user = User::where('api_token',$tkn)->first();
            if (isset($this_user) && isset($this_user->id)) {
                $ads = Ad::where('user_id',$this_user->id)->orderBy('id', 'desc')->skip($skip_ad)->take($take_ad)->get();
            }
        }
        if (isset($ads)) {
            $output = Ad::PrepareAdsForMapAjax($ads,$lat,$lng);
        }
        return $output;
    }
    static public function PrepareProfileAdsAjax($user_id,$take_ad,$skip_ad,$tkn,$lat,$lng) {
        $output = null;
        if (isset($tkn)) {
            $this_user = User::find($user_id);
            if (isset($this_user)) {
                $ads = Ad::where('user_id',$this_user->id)->orderBy('id', 'asc')->skip($skip_ad)->take($take_ad)->get();
            }
        }
        if (isset($ads)) {
            $output = Ad::PrepareAdsForMapAjax($ads,$lat,$lng);
        }
        return $output;
    }
    static public function PrepareAdsMapHashtag($hashtag,$lat,$lng,$radius) {
        $output = null;
        $adds_arary = array();
        if ($lat==0||$lat=='0'||$lng==0||$lng=='0') {
            $ads = Ad::where('status',1)->where('cat_id',$cat_id)->orderBy('id', 'desc')->get();
        } else {
            $xads = Ad::select(
                 \DB::raw("*,
                ( 3959 * acos( cos( radians(" . $lat . ") ) *
                cos( radians( lat ) )
                * cos( radians( lng ) - radians(" . $lng . ")
                ) + sin( radians(" . $lat . ") ) *
                sin( radians( lat ) ) )
                ) AS distance"))
                ->having("distance", "<", $radius)
                ->orderBy("distance")
                ->get();

                if (isset($xads)) {
                    foreach ($xads as $ak => $av) {
                        $flag = 0;
                        if (isset($av['htag'])) {
                            $error_reporting = error_reporting(error_reporting() ^ E_NOTICE);
                            $tht = unserialize($av['htag']);
                            if($tht) {
                                foreach ($tht as $ht => $hv) {
                                    if ($hashtag == $hv) {
                                        $flag = 1;
                                    }
                                }
                            }
                        }
                        if ($flag == 1) {
                            array_push($adds_arary,$av['id']);
                        }
                        
                    }
                }
                if (isset($adds_arary) && !empty($adds_arary)) {
                    $ads = Ad::where('status',1)->whereIn('id', $adds_arary)->get();
                }

        }
        if (isset($ads)) {
            $output = Ad::PrepareAdsForMap($ads,$lat,$lng);
        }
        return $output;
    }
    static public function PrepareAdsSearchCity($city_id) {
        $output = null;
        $ads = Ad::where('status',1)->where('city',$city_id)->paginate(8);
        if (isset($ads)) {
            $output = Ad::PrepareAdsForHome($ads);
        }
        return $output;
    }
    static public function PrepareCategoriesHtml() {
        $html = '<div class="cats-holder">';
        $f_image = DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'home'.DIRECTORY_SEPARATOR.'categories'.DIRECTORY_SEPARATOR.'category';
        for ($i=1; $i <= 8; $i++) { 
            $html .= '<div
                style="
                    padding:5px !important;
                    border: 0;

                "
             class="col-md-4 col-sm-12 col-xs-12 cats-wrap-main">';
                $html .= ' <div class="cat-image links" cat-id="'.$i.'" subcat-id="1" style="background-image: url(';
                $html .= $f_image.'-'.$i.'.jpg';
                $html .= ');">';                    
                $html .= '</div>';
                switch ($i) {
                    case 1:
                        $html .= '<div class="cat-text-holder"><span>Lodging</span></div>';
                        break;
                    case 2:
                        $html .= '<div class="cat-text-holder"><span>Restaurant</span></div>';
                        break;
                    case 3:
                        $html .= '<div class="cat-text-holder"><span>Real Estate</span></div>';
                        break;
                    case 4:
                        $html .= '<div class="cat-text-holder"><span>Move In/Out</span></div>';
                        break;
                    case 5:
                        $html .= '<div class="cat-text-holder"><span>Used Car</span></div>';
                        break;
                    case 6:
                        $html .= '<div class="cat-text-holder"><span>Events</span></div>';
                        break;
                    case 7:
                        $html .= '<div class="cat-text-holder"><span>Flea Market</span></div>';
                        break;
                    case 8:
                        $html .= '<div class="cat-text-holder"><span>Fun</span></div>';
                        break;
                    
                    default:
                        # code...
                        break;
                }
                
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }
    static public function PrepareAdsForHome($data) {

        $data_a = array();
        $data_a['html'] = '<div class="text-center"><h3 id="no-data">No results found, Try looking into other categories!</h3></div>';
        $data_a['data'] = $data;
        if (isset($data)) {
            if (count($data)>0) {
                $data_a['html'] = '';
            }
            foreach ($data as $dk => $dv) {

                $cat_text = Ad::TranslateCat($dv->cat_id);
                $subcat_text = Ad::TranslateSubCat($dv->cat_id,$dv->subcat_id);
                $city_text = Ad::TranslateCity($dv->city);
                $isinwl = count(Wishlist::where('ad_id',$dv->id)->first());
                $_wlcolor = $isinwl>0?"rgb(0, 128, 0)":"#B3AFA8";
                $new_t = '';
                $new_des = '';
                if (isset($dv['title'])) {
                    $t_temp = $dv['title'];
                    $new_t = strlen($t_temp)>20?substr($t_temp,0,20)."...":$t_temp;
                }
                if (isset($dv['description'])) {
                    $des_temp = json_decode($dv['description']);
                    $new_des = strlen($des_temp)>30?substr($des_temp,0,30)."...":$des_temp;
                }
                $f_image = '/assets/images/home/product1.jpg';
                $poster_id = $dv['user_id'];
                
                if ((isset($dv['file_srcs'])) && ($dv['file_srcs'] != "null")) {
                    $src_temp = json_decode($dv['file_srcs'],true);
                    $f_image = (isset($src_temp[0]['image']['name']))?'/assets/images/posts/'.$poster_id.'/prm/image/'.$src_temp[0]['image']['name']:'/assets/images/home/product1.jpg';
                }

                $data_a['html'] .= '
                        <div class="col-md-3 col-sm-6 col-xs-12 my-col sin-ad">
                            <div class="product-image-wrapper">
                                <div class="single-products m-vad pointer" data="'.$dv->id.'">
                                    <div class="productinfo text-center infoholder">
                                        <div class="ad-image" style="background-image: url(';

                $data_a['html'] .= $f_image;
                $data_a['html'] .= ');">';                    
                $data_a['html'] .= '    </div>
                                        <h2>'.$new_t.'</h2>
                                        <p>'.$new_des.'</p>
                                    </div>
                                    <div class="product-overlay">
                                    </div>
                                    <div class="label-holder" style="font-size: 15px;text-align:center">
                                        <span class="label label-primary">'.$city_text.'</span>
                                        <span class="label label-success">'.$cat_text.'</span>
                                        <span class="label label-info">'.$subcat_text.'</span>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li>
                                        <a style="color:'.$_wlcolor.'" data="'.$dv->id.'" class="add-to-wishlist pointer"><i class="fa fa-plus-square"></i>&nbsp;Add to wishlist</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                ';
            }
        }
        return $data_a;
    }

    static public function PrepareAdsForHomeApi($data) {
        $bp =Job::ReturnBp();
        $data_a = array();
        $data_a['html'] = '<div class="text-center"><h3 id="no-data">No results found, Try looking into other categories!</h3></div>';
        $data_a['data'] = $data;
        $data_a['empty'] = 1;
        if (isset($data)) {
            if (count($data)>0) {
                $data_a['empty'] = 0;
                $data_a['html'] = '';
            }
            foreach ($data as $dk => $dv) {

                $cat_text = Ad::TranslateCat($dv->cat_id);
                $subcat_text = Ad::TranslateSubCat($dv->cat_id,$dv->subcat_id);
                $city_text = Ad::TranslateCity($dv->city);
                $isinwl = count(Wishlist::where('ad_id',$dv->id)->first());
                $_wlcolor = $isinwl>0?"rgb(0, 128, 0)":"#B3AFA8";
                $new_t = '';
                $new_des = '';
                if (isset($dv['title'])) {
                    $t_temp = $dv['title'];
                    $new_t = strlen($t_temp)>20?mb_substr($t_temp,0,20, "utf-8")."...":$t_temp;
                    // $new_t =utf8_decode($new_t0);
                }
                if (isset($dv['description'])) {
                    $des_temp = json_decode($dv['description']);
                    $new_des = strlen($des_temp)>30?mb_substr($des_temp,0,30,"utf-8")."...":$des_temp;
                }
                $f_image = $bp.'/assets/images/home/product1.jpg';
                $poster_id = $dv['user_id'];
                
                if ((isset($dv['file_srcs'])) && ($dv['file_srcs'] != "null")) {
                    $src_temp = json_decode($dv['file_srcs'],true);
                    $f_image = (isset($src_temp[0]['image']['name']))?$bp.'/assets/images/posts/'.$poster_id.'/prm/image/'.$src_temp[0]['image']['name']:$bp.'/assets/images/home/product1.jpg';
                }

                $data_a['html'] .= '
                        <div class="col-md-3 col-sm-6 col-xs-12 my-col sin-ad">
                            <div class="product-image-wrapper">
                                <div class="single-products m-vad pointer" data="'.$dv->id.'">
                                    <div class="productinfo text-center infoholder">
                                        <div class="ad-image" style="background-image: url(';

                $data_a['html'] .= $f_image;
                $data_a['html'] .= ');">';                    
                $data_a['html'] .= '    </div>
                                        <h2>'.$new_t.'</h2>
                                        <p>'.$new_des.'</p>
                                    </div>
                                    <div class="product-overlay">
                                    </div>
                                    <div class="label-holder" style="font-size: 15px;text-align:center">
                                        <span class="label label-primary">'.$city_text.'</span>
                                        <span class="label label-success">'.$cat_text.'</span>
                                        <span class="label label-info">'.$subcat_text.'</span>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li>
                                        <a style="color:'.$_wlcolor.'" data="'.$dv->id.'" class="add-to-wishlist pointer"><i class="fa fa-plus-square"></i>&nbsp;Add to wishlist</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                ';
            }
        }
        return $data_a;
    }
    static public function PrepareAdsForMap($data,$orlat,$orlng) {
        $data_array = array();
        if (isset($data)) {
            foreach ($data as $dk => $dv) {
                $data_array[$dk] = array(   'id' => '',
                                            'lat' => '',
                                            'lng' => '',
                                            'title' => '',
                                            'des' =>'',
                                            'dis' =>''
                                        );

                
                $data_array[$dk]['id'] = $dv['id'];
                $data_array[$dk]['lat'] = $dv['lat'];
                $data_array[$dk]['lng'] = $dv['lng'];

                $ndis = Job::distance($dv['lat'],$dv['lng'],$orlat,$orlng,"K",2);
                $dun = ' KM';
                // Job::dump($ndis);
                if ($ndis<=1.0) {
                    // Job::dump('here m');
                    $dun = ' M';
                    $ndis = Job::distance($dv['lat'],$dv['lng'],$orlat,$orlng,"M",0);
                }

                $data_array[$dk]['dis'] = $ndis.$dun;

                $new_t = '';
                $new_des = '';
                if (isset($dv['title'])) {
                    $t_temp = $dv['title'];
                    $data_array[$dk]['title'] = strlen($t_temp)>20?mb_substr($t_temp,0,20, "utf-8")."...":$t_temp;
                    // $new_t =utf8_decode($new_t0);
                }
                if (isset($dv['description'])) {
                    $des_temp = json_decode($dv['description']);
                    $data_array[$dk]['des'] = strlen($des_temp)>30?mb_substr($des_temp,0,30,"utf-8")."...":$des_temp;
                }
            }
        }
        return $data_array;
    }
    static public function PrepareAdsForMapAjax($data,$orlat,$orlng) {
        $data_array = array();
        $bp =Job::ReturnBp();
        if (isset($data)) {
            foreach ($data as $dk => $dv) {
                $data_array[$dk] = array(   'id' => '',
                                            'lat' => '',
                                            'lng' => '',
                                            'title' => '',
                                            'des' =>'',
                                            'dis' =>'',
                                            'imgsrc'=>'',
                                            'user_email'=>'',
                                            'user_id'=>'',
                                            'time_ago' => '',
                                            'img_w' => '',
                                            'img_h' => ''
                                        );

                $cur_user_id = $dv['user_id'];
                $data_array[$dk]['id'] = $dv['id'];
                $data_array[$dk]['lat'] = $dv['lat'];
                $data_array[$dk]['lng'] = $dv['lng'];
                $data_array[$dk]['user_id'] = $cur_user_id;

                $data_array[$dk]['time_ago'] = Job::formatTimeAgo(Job::humanTiming($dv['created_at']));

                //GET USEREMAIL
                $data_array[$dk]['user_email'] = Job::obfuscate_email(User::where('id',$cur_user_id)->value('email'));

                $poster_id = $dv['user_id'];
                $ndis = Job::distance($dv['lat'],$dv['lng'],$orlat,$orlng,"K",2);
                $dun = ' KM';
                // Job::dump($ndis);
                if ($ndis<=1.0) {
                    // Job::dump('here m');
                    $dun = ' M';
                    $ndis = Job::distance($dv['lat'],$dv['lng'],$orlat,$orlng,"M",0);
                }

                $data_array[$dk]['dis'] = $ndis.$dun;

                $new_t = '';
                $new_des = '';
                if (isset($dv['title'])) {
                    $t_temp = $dv['title'];
                    $data_array[$dk]['title'] = strlen($t_temp)>20?mb_substr($t_temp,0,20, "utf-8")."...":$t_temp;
                    // $new_t =utf8_decode($new_t0);
                }
                if (isset($dv['description'])) {
                    $des_temp = json_decode($dv['description']);
                    $data_array[$dk]['des'] = strlen($des_temp)>30?mb_substr($des_temp,0,30,"utf-8")."...":$des_temp;
                }
                
                if ((isset($dv['file_srcs'])) && ($dv['file_srcs'] != "null")) {
                    $src_temp = json_decode($dv['file_srcs'],true);
                    $data_array[$dk]['imgsrc'] = (isset($src_temp[0]['image']['name']))?$bp.'/assets/images/posts/'.$poster_id.'/prm/image/'.$src_temp[0]['image']['name']:$bp.'/assets/images/home/product1.jpg';
                    list($data_array[$dk]['img_w'], $data_array[$dk]['img_h']) = getimagesize($data_array[$dk]['imgsrc']);
                }
            }
        }
        return $data_array;
    }

    static public function PrepareAdsScrollLoadApi($data) {
        $bp =Job::ReturnBp();
        $data_a = array();
        $data_a['html'] = '';
        $data_a['empty'] =  1;
        if (isset($data)) {
            if (count($data)>0) {
                $data_a['empty'] = 0;
                $data_a['html'] = '';
            }
            foreach ($data as $dk => $dv) {

                $cat_text = Ad::TranslateCat($dv->cat_id);
                $subcat_text = Ad::TranslateSubCat($dv->cat_id,$dv->subcat_id);
                $city_text = Ad::TranslateCity($dv->city);


                $isinwl = count(Wishlist::where('ad_id',$dv->id)->first());
                $_wlcolor = $isinwl>0?"rgb(0, 128, 0)":"#B3AFA8";

                $new_t = '';
                $new_des = '';
                if (isset($dv['title'])) {
                    $t_temp = $dv['title'];
                    $new_t = strlen($t_temp)>20?substr($t_temp,0,20)."...":$t_temp;
                }
                if (isset($dv['description'])) {
                    $des_temp = json_decode($dv['description']);
                    $new_des = strlen($des_temp)>30?substr($des_temp,0,30)."...":$des_temp;
                }

                $f_image = $bp.'/assets/images/home/product1.jpg';
                $poster_id = $dv['user_id'];


                if ((isset($dv['file_srcs'])) && ($dv['file_srcs'] != "null")) {
                    $src_temp = json_decode($dv['file_srcs'],true);
                    $f_image = (isset($src_temp[0]['image']['name']))?$bp.'/assets/images/posts/'.$poster_id.'/prm/image/'.$src_temp[0]['image']['name']:$bp.'/assets/images/home/product1.jpg';
                }

               $data_a['html'] .= '
                        <div class="col-md-3 col-sm-6 col-xs-12 my-col sin-ad">
                            <div class="product-image-wrapper">
                                <div class="single-products m-vad pointer" data="'.$dv->id.'">
                                    <div class="productinfo text-center infoholder">
                                        <div class="ad-image" style="background-image: url(';

                $data_a['html'] .= $f_image;
                $data_a['html'] .= ');">';                    
                $data_a['html'] .= '    </div>
                                        <h2>'.$new_t.'</h2>
                                        <p>'.$new_des.'</p>
                                    </div>
                                    <div class="product-overlay">
                                    </div>
                                    <div class="label-holder" style="font-size: 15px;text-align:center">
                                        <span class="label label-primary">'.$city_text.'</span>
                                        <span class="label label-success">'.$cat_text.'</span>
                                        <span class="label label-info">'.$subcat_text.'</span>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li>
                                        <a style="color:'.$_wlcolor.'" data="'.$dv->id.'" class="add-to-wishlist pointer"><i class="fa fa-plus-square"></i>&nbsp;Add to wishlist</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                ';
            }
        }
        return $data_a;
    }
    static public function PrepareAdsForHomeHTML($data) {

        $data_a = array();
        $data_a['html'] = '<div class="text-center"><h3 id="no-data">No results found, Try looking into other categories!</h3></div>';
        if (isset($data)) {
            if (count($data)>0) {
                $data_a['html'] = '';
            }
            foreach ($data as $dk => $dv) {

                $cat_text = Ad::TranslateCat($dv->cat_id);
                $subcat_text = Ad::TranslateSubCat($dv->cat_id,$dv->subcat_id);
                $city_text = Ad::TranslateCity($dv->city);


                $isinwl = count(Wishlist::where('ad_id',$dv->id)->first());
                $_wlcolor = $isinwl>0?"rgb(0, 128, 0)":"#B3AFA8";

                $new_t = '';
                $new_des = '';
                if (isset($dv['title'])) {
                    $t_temp = $dv['title'];
                    $new_t = strlen($t_temp)>20?substr($t_temp,0,20)."...":$t_temp;
                }
                if (isset($dv['description'])) {
                    $des_temp = json_decode($dv['description']);
                    $new_des = strlen($des_temp)>30?substr($des_temp,0,30)."...":$des_temp;
                }

                $f_image = DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'home'.DIRECTORY_SEPARATOR.'product1.jpg';
                $poster_id = $dv['user_id'];


                if (isset($dv['file_srcs']) && $dv['file_srcs'] != "null") {
                    $src_temp = json_decode($dv['file_srcs'],true);
                    $images_array = array();
                    if (isset($src_temp)) {
                        foreach ($src_temp as $stkey => $stvalue) {
                            foreach ($stvalue as $imkey => $imvalue) {
                                if ($imkey == "image") {
                                    $un_path = 'assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$poster_id.DIRECTORY_SEPARATOR.'prm'.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.$imvalue['name'];
                                        if (file_exists($un_path)) {
                                            $images_array[$stkey] = $un_path;
                                        }   
                                }
                            }
                        }
                    }
                }

                $data_a['html'] .= '
                        <div class="col-md-3 col-sm-6 col-xs-12 my-col sin-ad updated_ads" style="display:none">
                            <div class="product-image-wrapper">
                                <div class="single-products m-vad pointer" data="'.$dv->id.'">
                                    <div class="productinfo text-center infoholder">
                                        <div class="ad-image" style="background-image: url(';

                if (isset($dv['file_srcs']) && $dv['file_srcs'] != "null") {
                    foreach ($images_array as $fgkey => $fgvalue) {
                        $data_a['html'] .= $fgvalue;
                    }
                } else {
                    $data_a['html'] .= $f_image;
                }    
                $data_a['html'] .= ');">';                    
                $data_a['html'] .= '    </div>
                                        <h2>'.$new_t.'</h2>
                                        <p>'.$new_des.'</p>

                                    </div>
                                    <div class="product-overlay">
                                    </div>
                                        <div class="label-holder label" style="font-size: 15px;">
                                            <div class="label-div-s"><span">'.$city_text.'</span></div>
                                            <div class="label-div-p"><span">'.$cat_text.'</span></div>
                                            <div class="label-div-i"><span">'.$subcat_text.'</span></div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li>
                                        <a style="color:'.$_wlcolor.'" data="'.$dv->id.'" class="add-to-wishlist pointer"><i class="fa fa-plus-square"></i>Add to wishlist</a>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                ';
            }
        }
        return $data_a;
    }

    static public function PrepareAdsScrollLoad($data) {

        $data_a = array();
        $data_a['html'] = '';
        if (isset($data)) {
            if (count($data)>0) {
                $data_a['html'] = '';
            }
            foreach ($data as $dk => $dv) {

                $cat_text = Ad::TranslateCat($dv->cat_id);
                $subcat_text = Ad::TranslateSubCat($dv->cat_id,$dv->subcat_id);
                $city_text = Ad::TranslateCity($dv->city);


                $isinwl = count(Wishlist::where('ad_id',$dv->id)->first());
                $_wlcolor = $isinwl>0?"rgb(0, 128, 0)":"#B3AFA8";

                $new_t = '';
                $new_des = '';
                if (isset($dv['title'])) {
                    $t_temp = $dv['title'];
                    $new_t = strlen($t_temp)>20?substr($t_temp,0,20)."...":$t_temp;
                }
                if (isset($dv['description'])) {
                    $des_temp = json_decode($dv['description']);
                    $new_des = strlen($des_temp)>30?substr($des_temp,0,30)."...":$des_temp;
                }

                $f_image = DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'home'.DIRECTORY_SEPARATOR.'product1.jpg';
                $poster_id = $dv['user_id'];


                if (isset($dv['file_srcs']) && $dv['file_srcs'] != "null") {
                    $src_temp = json_decode($dv['file_srcs'],true);
                    $images_array = array();
                    if (isset($src_temp)) {
                        foreach ($src_temp as $stkey => $stvalue) {
                            foreach ($stvalue as $imkey => $imvalue) {
                                if ($imkey == "image") {
                                    $un_path = 'assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$poster_id.DIRECTORY_SEPARATOR.'prm'.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.$imvalue['name'];
                                        if (file_exists($un_path)) {
                                            $images_array[$stkey] = $un_path;
                                        }   
                                }
                            }
                        }
                    }
                }

                $data_a['html'] .= '
                        <div class="col-md-3 col-sm-6 col-xs-12 my-col sin-ad updated_ads" style="display:none">
                            <div class="product-image-wrapper">
                                <div class="single-products m-vad pointer" data="'.$dv->id.'">
                                    <div class="productinfo text-center infoholder">
                                        <div class="ad-image" style="background-image: url(';

                if (isset($dv['file_srcs']) && $dv['file_srcs'] != "null") {
                    foreach ($images_array as $fgkey => $fgvalue) {
                        $data_a['html'] .= $fgvalue;
                    }
                } else {
                    $data_a['html'] .= $f_image;
                }    
                $data_a['html'] .= ');">';                    
                $data_a['html'] .= '    </div>
                                        <h2>'.$new_t.'</h2>
                                        <p>'.$new_des.'</p>

                                    </div>
                                    <div class="product-overlay">
                                    </div>
                                        <div class="label-holder label" style="font-size: 15px;">
                                            <div class="label-div-s"><span">'.$city_text.'</span></div>
                                            <div class="label-div-p"><span">'.$cat_text.'</span></div>
                                            <div class="label-div-i"><span">'.$subcat_text.'</span></div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li>
                                        <a style="color:'.$_wlcolor.'" data="'.$dv->id.'" class="add-to-wishlist pointer"><i class="fa fa-plus-square"></i>Add to wishlist</a>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                ';
            }
        }
        return $data_a;
    }
    static public function PrepareForEdit($data) {

        if (isset($data)) {
            if (isset($data['cat_id'])) {
               $data['subcats_select'] =  Job::perpare_subcat($data['cat_id']);
            }
            if (isset($data['description'])) {
               $data['des'] =  json_decode($data['description']);
            }
            if (isset($data['file_srcs'])) {
                $files = json_decode($data['file_srcs'],true);
                $base_path = DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.Auth::id().DIRECTORY_SEPARATOR.'prm'.DIRECTORY_SEPARATOR;
                $data['decoded_files'] = $files;
                $data['base-path'] = $base_path;
                unset($data['file_srcs']);
            }
        }

        return $data;
    }
    static public function PrepareForView($data) {
        //main image
        $mi = '';
        $data_array = array('title_txt'=>'',
                            'title'=>'',
                            'des'=>'',
                            'images'=>'',
                            'videos'=>'',
                            'images_array'=>array(),
                            'lat'=>'',
                            'lng'=>'',
                            'drivebtn'=>'',
                            'fbs'=>'',
                            'rvs-count'=>'',
                            'rvs-rate'=>''
                            );

        if (isset($data)) {

            //Get Reviews
                $reviews = Review::where('ad_id',$data['id'])->get();
                $r_count = 0;
                $r_sum = 0;
                $r_avg = 8;
                foreach ($reviews as $rvk => $rvv) {
                    $r_count++;
                    $r_sum += $rvv['rate'];
                }
                if ($r_count>0) {
                    $r_sum += 8;
                    $r_count += 1;
                    $r_avg = $r_sum/$r_count;
                }
                $data_array['rvs-count'] = $r_count;
                $data_array['rvs-rate'] = $r_avg;
            //Get Reviews



            if (isset($data['file_srcs']) && $data['file_srcs'] != 'null') {
                $files = json_decode($data['file_srcs'],true);
                $base_path = '/assets/images/posts/'.$data['user_id'].'/prm/';
                foreach ($files as $fk => $fv) {
                    foreach ($fv as $fvk => $fvv) {
                        if ($fvk=="image") {
                            $imgs = $base_path.$fvk.'/'.$fvv['name'];
                            $data_array['images'] .= '<a href="'.$imgs.'" class="my-item _p'.$data->id.' "><img style="max-width:100px" src="'.$imgs.'" alt="..."></a>';
                            $data_array['images_array'][$fk]['src'] = $imgs;
                            if ($fk==0) {
                                $mi=$imgs;
                            }
                        }
                    }
                }
                foreach ($files as $fk => $fv) {
                    foreach ($fv as $fvk => $fvv) {
                        if ($fvk=="video") {
                            $data_array['videos'] .= '<div class="" style="width:100%">
                                    <video style="width:100%" class="" frameborder="0" controls>
                                        <source src="'.$base_path.$fvk.DIRECTORY_SEPARATOR.$fvv['name'].'" type="video/mp4">
                                    </video>
                                </div>';
                        }
                    }
                }
            }

            if (isset($data['description'])) {
                $des_jd = json_decode($data['description']);
                $data_array['title_txt'] =  $data->title;
                $data_array['title'] =  "<h3 class='nat' style='margin-top: 0'>".$data->title."</h3>";
                $data_array['des'] =  "<p class='nades'>".$des_jd."</p>";

                //FACEBOOK SHARE BUTTON
                $data_array['fbs'] = '
                    <a  role="button"  target="_blank" class="btn btn-primary fb-share"  
                        title='.$data->title.' 
                        href="https://www.facebook.com/dialog/feed?
                          app_id=1728054614082756&amp;
                          display=popup&amp;
                          caption=Better Life In Korea&amp;
                          description='.$des_jd.' &amp;
                          name='.$data->title.'&amp;
                          link='.Request::root().'/posts/'.$data->id.'&amp;
                          redirect_uri='.Request::root().'&amp;
                          picture='.Request::root().$mi.'">
                          <i class="fa fa-lg fa-facebook"></i>
                          Share
                    </a>';
            }

            if (isset($data['lat'])&&isset($data['lng'])) {
                $data_array['lat'] = $data['lat'];
                $data_array['lng'] = $data['lng'];

                $walink = "";

                //drive to
                $data_array['drivebtn'] ='
                <div style="width:100%" class="btn-group btn-block" role="group" aria-label="...">
                  <button lat="'.$data["lat"].'" lng="'.$data["lng"].'" id="waze-drive-to" style="width:90%" type="button" class="btn btn-primary">Drive To Location <i class="fa fa-car" aria-hidden="true"></i></button>
                    <button 
                        style="width:10%" 
                        id="waze-info" 
                        data-toggle="tooltip" 
                        data-html="true" 
                        data-placement="top" 
                        title="Make sure Waze - GPS, Maps & Traffic App is installed on your device" 
                        type="button" 
                        class="btn btn-primary">
                        <i class="fa fa-info-circle" aria-hidden="true">
                        </i>
                    </button>
                </div>
                <a id="ntdum" title="'.$data->title.'" lat="'.$data["lat"].'" lng="'.$data["lng"].'" class="btn btn-success btn-block">Daum Maps</a>
                <hr>';
            }
        }
        return $data_array;
    }

    static public function PrepareForViewApi($data,$user_token) {
        //main image
        $mi = '';

        $bp =Job::ReturnBp();
        $data_array = array('title_txt'=>'',
                            'title'=>'',
                            'des'=>'',
                            'des_txt'=>'',
                            'images'=>'',
                            'videos'=>'',
                            'images_array'=>array(),
                            'lat'=>'',
                            'lng'=>'',
                            'simage'=>'',
                            'rvs-count'=>'',
                            'rvs-rate'=>'',
                            'coms'=>''
                            );

        if (isset($data)) {
            // GET Comment
            $comments = Comment::where('post_id',$data['id'])->get();
            $data_array['coms'] = '<ul class="comments">';

            if (isset($comments) && !empty($comments)) {
                foreach ($comments as $kco => $vco) {
                    $this_rate = 0;
                    $couser = User::where('id',$vco['user_id'])->first();
                    $data_array['coms'] .='<li tc="'.$vco['id'].'" class="clearfix coli">
                                  <div class="post-comments">
                                      <p class="meta">'.date("M j Y", strtotime($vco['created_at'])).' <a href="#">'.substr($couser['email'], 0, 4).'***</a> says :';

                    if (isset($user_token)) {
                        $trate = Review::where('ad_id',$data['id'])->where('user_id',$vco['user_id'])->first();
                        if (isset($trate)&& !empty($trate)) {
                            $this_rate = $trate->rate;
                        }
                        $curu = User::where('api_token',$user_token)->first();
                        if (isset($curu)&&!empty($curu)) {
                            if ($curu->id == $vco['user_id']) {
                                $data_array['coms'] .= '<i class="pull-right"><a class="delcom" href="#">
                                            <small>Delete</small>
                                            </a>
                                            </i>
                                        <span class="comrw pull-right"><input name="input-name" type="number" class="rating comrate" min=1 max=10 step=0.5 data-size="xs" data-rtl="false" disabled="true" value="'.$this_rate.'"></span>
                                    </p>';
                            }
                        }
                    }                            

                    $data_array['coms'] .= '<p>
                                          '.$vco['comment'].'
                                      </p>
                                  </div>
                                 </li>';
                }
            }
            $data_array['coms'] .=    '<li id="snd-li" class="clearfix">
                                  <div class="post-comments sendcomment">
                                    <textarea id="_rt" placeholder="Write a Review"></textarea>
                                    <a href="#" class="btn btn-default btn-sm rvcom" revstar="999" >Send</a>
                                    <input name="comment-rev" type="number" class="rating sbtnrev">
                                  </div>
                                </li>
                              </ul>';
            // GET Comment

            //Get Reviews
            $reviews = Review::where('ad_id',$data['id'])->get();
            $r_count = 0;
            $r_sum = 0;
            $r_avg = 8;
            foreach ($reviews as $rvk => $rvv) {
                $r_count++;
                $r_sum += $rvv['rate'];
            }
            if ($r_count>0) {
                $r_sum += 8;
                $r_count += 1;
                $r_avg = $r_sum/$r_count;
            }
            $data_array['rvs-count'] = $r_count;
            $data_array['rvs-rate'] = $r_avg;
            //Get Reviews



            if (isset($data['file_srcs']) && $data['file_srcs'] != 'null') {
                $files = json_decode($data['file_srcs'],true);
                $base_path = $bp.'/assets/images/posts/'.$data['user_id'].'/prm/';
                foreach ($files as $fk => $fv) {
                    foreach ($fv as $fvk => $fvv) {
                        if ($fvk=="image") {
                            $imgs = $base_path.$fvk.'/'.$fvv['name'];
                            $data_array['images'] .= '<a href="'.$imgs.'" class="my-item _p'.$data->id.' "><img style="max-width:100px" src="'.$imgs.'" alt="..."></a>';
                            $data_array['images_array'][$fk]['src'] = $imgs;
                            if ($fk==0) {
                                $mi=$imgs;
                            }
                        }
                    }
                }
                foreach ($files as $fk => $fv) {
                    foreach ($fv as $fvk => $fvv) {
                        if ($fvk=="video") {
                            $data_array['videos'] .= '<div class="" style="width:100%">
                                    <video style="width:100%" class="" frameborder="0" controls>
                                        <source src="'.$base_path.$fvk.DIRECTORY_SEPARATOR.$fvv['name'].'" type="video/mp4">
                                    </video>
                                </div>';
                        }
                    }
                }
            }

            if (isset($data['description'])) {
                $des_jd = json_decode($data['description']);
                $data_array['title_txt'] =  $data->title;
                $data_array['title'] =  "<h3 class='nat' style='margin-top: 0'>".$data->title."</h3>";
                $data_array['des_txt'] =  $des_jd;
                $data_array['des'] =  "<p class='nades'>".$des_jd."</p>";
                
                $data_array['simage'] = $mi;
            }

            if (isset($data['lat'])&&isset($data['lng'])) {
                $data_array['lat'] = $data['lat'];
                $data_array['lng'] = $data['lng'];

            }
        }
        return $data_array;
    }

    static public function E_PrepareForViewApi($data,$user_token) {
        //main image
        $mi = '';

        $bp =Job::ReturnBp();
        $data_array = array('title_txt'=>'',
                            'title'=>'',
                            'des'=>'',
                            'des_txt'=>'',
                            'images'=>'',
                            'videos'=>'',
                            'images_array'=>array(),
                            'lat'=>'',
                            'lng'=>'',
                            'simage'=>''
                            );

        if (isset($data)) {

            if (isset($data['file_srcs']) && $data['file_srcs'] != 'null') {
                $files = json_decode($data['file_srcs'],true);
                $base_path = $bp.'/assets/images/posts/'.$data['user_id'].'/prm/';
                foreach ($files as $fk => $fv) {
                    foreach ($fv as $fvk => $fvv) {
                        if ($fvk=="image") {
                            $imgs = $base_path.$fvk.'/'.$fvv['name'];
                            $data_array['images'] .= '<a href="'.$imgs.'" class="my-item _p'.$data->id.' "><img style="max-width:100px" src="'.$imgs.'" alt="..."></a>';
                            $data_array['images_array'][$fk]['src'] = $imgs;
                            if ($fk==0) {
                                $mi=$imgs;
                            }
                        }
                    }
                }
                foreach ($files as $fk => $fv) {
                    foreach ($fv as $fvk => $fvv) {
                        if ($fvk=="video") {
                            $data_array['videos'] .= '<div class="" style="width:100%">
                                    <video style="width:100%" class="" frameborder="0" controls>
                                        <source src="'.$base_path.$fvk.DIRECTORY_SEPARATOR.$fvv['name'].'" type="video/mp4">
                                    </video>
                                </div>';
                        }
                    }
                }
            }

            if (isset($data['description'])) {
                $des_jd = json_decode($data['description']);
                $data_array['title_txt'] =  $data->title;
                $data_array['title'] =  "<h3 class='nat' style='margin-top: 0'>".$data->title."</h3>";
                $data_array['des_txt'] =  $des_jd;
                $data_array['des'] =  "<p class='nades'>".$des_jd."</p>";
                
                $data_array['simage'] = $mi;
            }

            if (isset($data['lat'])&&isset($data['lng'])) {
                $data_array['lat'] = $data['lat'];
                $data_array['lng'] = $data['lng'];

            }
        }
        return $data_array;
    }





    static public function TranslateCat($data) {
        $ttxt = '';
        if (isset($data)) {
            switch ($data) {
                case '1':
                    $ttxt = 'Lodging';
                    break;
                case '2':
                    $ttxt = 'Restaurant';
                    break;
                case '3':
                    $ttxt = 'Real Estate';
                    break;
                case '4':
                    $ttxt = 'Moving In/Out';
                    break;
                case '5':
                    $ttxt = 'Used Car';
                    break;
                case '6':
                    $ttxt = 'Events';
                    break;
                case '7':
                    $ttxt = 'Flea Market';
                    break;
                case '8':
                    $ttxt = 'Fun';
                    break;
                
                default:
                    $ttxt = '-';
                    break;
            }
        }
        return $ttxt;
    }
    static public function TranslateCity($data) {
        $cttxt = '';
        if (isset($data)) {
            switch ($data) {
                case '1':
                $cttxt = 'Pyeongtaek Downtown';
                break;
                case '2':
                $cttxt = 'Incheon';
                break;
                case '3':
                $cttxt = 'Dongchang-ri';
                break;
                case '4':
                $cttxt = 'Cheonan';
                break;
                case '5':
                $cttxt = 'Songtan';
                break;
                case '6':
                $cttxt = 'Anjeong-ri';
                break;
            }
        }
        return $cttxt;
    }
    static public function TranslateSubCat($cat,$data) {
        $ttxt = '';
        if (isset($data,$cat)) {
            switch ($cat) {
                case '5':
                case '6':
                case '1':
                    switch ($data) {
                        case '1':
                            $ttxt = 'Agency';
                            break;
                        case '2':
                            $ttxt = 'Private';
                            break;
                    }
                    break;
                case '2':
                    switch ($data) {
                        case '1':
                            $ttxt = 'Asian';
                            break;
                        case '2':
                            $ttxt = 'Italian';
                            break;
                        case '3':
                            $ttxt = 'Western';
                            break;
                        case '4':
                            $ttxt = 'Mexican';
                            break;
                        case '5':
                            $ttxt = 'Other';
                            break;
                    }
                    break;
                case '3':
                    switch ($data) {
                        case '1':
                            $ttxt = 'Agency';
                            break;
                        case '2':
                            $ttxt = 'Private';
                            break;
                        case '3':
                            $ttxt = 'Sofa Document Fee';
                            break;
                    }
                    break;
                case '4':
                    switch ($data) {
                        case '1':
                            $ttxt = 'Cleaning';
                            break;
                        case '2':
                            $ttxt = 'Services';
                            break;
                        case '3':
                            $ttxt = 'Moving Company';
                            break;
                        case '4':
                            $ttxt = 'CellPhone';
                            break;
                    }
                    break;

                default:
                    $ttxt = '-';
                    break;
            }
        }
        return $ttxt;
    }

}
