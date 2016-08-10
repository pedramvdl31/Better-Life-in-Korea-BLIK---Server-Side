<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Wishlist;
class Ad extends Model
{
    
    public static $rules_edit = array(
        'cat'=>'required',
        'subcat'=>'required',
        'city'=>'required',
        'title'=>'required',
        'description'=>'required'
    );
    static public function PrepareAdsSearchTxt($txtd) {
        $output = null;
        if (isset($txtd)) {
            $ads = Ad::where('status',1)->where('title', 'like', $txtd)
                ->paginate(8);

            if (isset($ads)) {
                $output = Ad::PrepareAdsForHome($ads);
            }
        }

        return $output;
    }
    
    static public function PrepareAdsSearchCategory($cat_id) {
        $output = null;
        $ads = Ad::where('status',1)->where('cat_id',$cat_id)->orderBy('id', 'desc')->take(8)->get();
        if (isset($ads)) {
            $output = Ad::PrepareAdsForHome($ads);
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
        for ($i=1; $i <= 7; $i++) { 
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
                        $html .= '<div class="cat-text-holder"><span>Real Estate</span></div>';
                        break;
                    case 2:
                        $html .= '<div class="cat-text-holder"><span>Restaurant</span></div>';
                        break;
                    case 3:
                        $html .= '<div class="cat-text-holder"><span>Used Car</span></div>';
                        break;
                    case 4:
                        $html .= '<div class="cat-text-holder"><span>Move In/Out</span></div>';
                        break;
                    case 5:
                        $html .= '<div class="cat-text-holder"><span>Flea Market</span></div>';
                        break;
                    case 6:
                        $html .= '<div class="cat-text-holder"><span>Events</span></div>';
                        break;
                    case 7:
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
                                <div class="single-products view-ad pointer" data="'.$dv->id.'">
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
                                        <div class="label-holder label" style="font-size: 15px;">
                                            <div class="label-div-s"><span">'.$city_text.'</span></div>
                                            <div class="label-div-p"><span">'.$cat_text.'</span></div>
                                            <div class="label-div-i"><span">'.$subcat_text.'</span></div>
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
                                <div class="single-products view-ad pointer" data="'.$dv->id.'">
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
                                <div class="single-products view-ad pointer" data="'.$dv->id.'">
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

        $data_array = array('title'=>'',
                            'des'=>'',
                            'images'=>'',
                            'videos'=>'',
                            'lat'=>'',
                            'lng'=>'',
                            'drivebtn'=>''
                            );

        if (isset($data)) {
            if (isset($data['description'])) {
               $data_array['title'] =  "<h3 style='margin-top: 0'>".$data->title."</h3>";
               $data_array['des'] =  "<p>".json_decode($data['description'])."</p>";
            }

            if (isset($data['file_srcs']) && $data['file_srcs'] != 'null') {
                $files = json_decode($data['file_srcs'],true);
                $base_path = '/assets/images/posts/'.$data['user_id'].'/prm/';
                foreach ($files as $fk => $fv) {
                    foreach ($fv as $fvk => $fvv) {
                        if ($fvk=="image") {
                            $imgs = $base_path.$fvk.DIRECTORY_SEPARATOR.$fvv['name'];
                            $data_array['images'] .= '<a href="'.$imgs.'" class="my-item _p'.$data->id.' "><img style="max-width:100px" src="'.$imgs.'" alt="..."></a>';
                            $data_array['images_array'][$fk]['src'] = $imgs;
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

            if (isset($data['lat'])&&isset($data['long'])) {
                $data_array['lat'] = $data['lat'];
                $data_array['lng'] = $data['long'];

                //drive to
                $data_array['drivebtn'] ='
                <div style="width:100%" class="btn-group btn-block" role="group" aria-label="...">
                  <button lat="'.$data["lat"].'" lng="'.$data["long"].'" id="waze-drive-to" style="width:90%" type="button" class="btn btn-primary">Drive To Location <i class="fa fa-car" aria-hidden="true"></i></button>
                  <button style="width:10%" id="waze-info"data-toggle="tooltip" data-placement="top" title="Make sure Waze - GPS, Maps & Traffic App is installed on your device" type="button" class="btn btn-primary"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
                </div><hr>';
            }
        }
        return $data_array;
    }



    static public function TranslateCat($data) {
        $ttxt = '';
        if (isset($data)) {
            switch ($data) {
                case '1':
                    $ttxt = 'Real Estate';
                    break;
                case '2':
                    $ttxt = 'Restaurant';
                    break;
                case '3':
                    $ttxt = 'Used Car';
                    break;
                case '4':
                    $ttxt = 'Moving In/Out';
                    break;
                case '5':
                    $ttxt = 'Flea Market';
                    break;
                case '6':
                    $ttxt = 'Events';
                    break;
                case '7':
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
                case '0':
                $cttxt = 'Seoul';
                break;
                case '1':
                $cttxt = 'Incheon';
                break;
                case '2':
                $cttxt = 'Paju';
                break;
                case '3':
                $cttxt = 'Cheonan';
                break;
                case '4':
                $cttxt = 'Yongin';
                break;
                case '5':
                $cttxt = 'Kwanghui-dong';
                break;
                case '6':
                $cttxt = 'Pon-dong';
                break;
                case '7':
                $cttxt = 'Gwangju';
                break;
                case '8':
                $cttxt = 'Gwangmyeong';
                break;
                case '9':
                $cttxt = 'Tang-ni';
                break;
                case '10':
                $cttxt = 'Busan';
                break;
                case '11':
                $cttxt = 'Seongnam-si';
                break;
                case '12':
                $cttxt = 'Suwon-si';
                break;
                case '13':
                $cttxt = 'Namyang';
                break;
                case '14':
                $cttxt = 'Namyangju';
                break;
                case '15':
                $cttxt = 'Jeju-si';
                break;
                case '16':
                $cttxt = 'Ulsan';
                break;
                case '17':
                $cttxt = 'Osan';
                break;
                case '18':
                $cttxt = 'Hanam';
                break;
                case '19':
                $cttxt = 'Pyong-gol';
                break;
                case '20':
                $cttxt = 'Anyang-si';
                break;
                case '21':
                $cttxt = 'Yangsan';
                break;
                case '22':
                $cttxt = 'Daejeon';
                break;
                case '23':
                $cttxt = 'Nonsan';
                break;
                case '24':
                $cttxt = 'Seocho';
                break;
                case '25':
                $cttxt = 'Wonju';
                break;
                case '26':
                $cttxt = 'Kisa';
                break;
                case '27':
                $cttxt = 'Daegu';
                break;
                case '28':
                $cttxt = 'Ansan-si';
                break;
                case '29':
                $cttxt = 'Gongju';
                break;
                case '30':
                $cttxt = 'Haeundae';
                break;
                case '31':
                $cttxt = 'Sasang';
                break;
                case '32':
                $cttxt = 'Bucheon-si';
                break;
                case '33':
                $cttxt = 'Chuncheon';
                break;
                case '34':
                $cttxt = 'Ilsan-dong';
                break;
                case '35':
                $cttxt = 'Naju';
                break;
                case '36':
                $cttxt = 'Jinju';
                break;
                case '37':
                $cttxt = 'Uiwang';
                break;
                case '38':
                $cttxt = 'Gangneung';
                break;
                case '39':
                $cttxt = 'Yongsan-dong';
                break;
                case '40':
                $cttxt = 'Pohang';
                break;
                case '41':
                $cttxt = 'Changwon';
                break;
                case '42':
                $cttxt = 'Jeonju';
                break;
                case '43':
                $cttxt = 'Yeosu';
                break;
                case '44':
                $cttxt = 'Songnim';
                break;
                case '45':
                $cttxt = 'Gimhae';
                break;
                case '46':
                $cttxt = 'Songjeong';
                break;
                case '47':
                $cttxt = 'Hyoja-dong';
                break;
                case '48':
                $cttxt = 'Icheon-si';
                break;
                case '49':
                $cttxt = 'Kimso';
                break;
                case '50':
                $cttxt = 'Iksan';
                break;
                case '51':
                $cttxt = 'Deokjin';
                break;
                case '52':
                $cttxt = 'Koyang-dong';
                break;
                case '53':
                $cttxt = 'Samsung';
                break;
                case '54':
                $cttxt = 'Anseong';
                break;
                case '55':
                $cttxt = 'Samjung-ni';
                break;
                case '56':
                $cttxt = 'Mapo-dong';
                break;
                case '57':
                $cttxt = 'Gunnae';
                break;
                case '58':
                $cttxt = 'Nae-ri';
                break;
                case '59':
                $cttxt = 'Suncheon';
                break;
                case '60':
                $cttxt = 'Okpo-dong';
                break;
                case '61':
                $cttxt = 'Moppo';
                break;
                case '62':
                $cttxt = 'Sangdo-dong';
                break;
                case '63':
                $cttxt = 'Cheongju-si';
                break;
                case '64':
                $cttxt = 'Chaeun';
                break;
                case '65':
                $cttxt = 'Taebuk';
                break;
                case '66':
                $cttxt = 'Yeoju';
                break;
                case '67':
                $cttxt = 'Seong-dong';
                break;
                case '68':
                $cttxt = 'Duchon';
                break;
                case '69':
                $cttxt = 'Gyeongju';
                break;
                case '70':
                $cttxt = 'Andong';
                break;
                case '71':
                $cttxt = 'Seosan City';
                break;
                case '72':
                $cttxt = 'Asan';
                break;
                case '73':
                $cttxt = 'Miryang';
                break;
                case '74':
                $cttxt = 'Wonmi-gu';
                break;
                case '75':
                $cttxt = 'Janghowon';
                break;
                case '76':
                $cttxt = 'Chungnim';
                break;
                case '77':
                $cttxt = 'Songam';
                break;
                case '78':
                $cttxt = 'Tongan';
                break;
                case '79':
                $cttxt = 'Apo';
                break;
                case '80':
                $cttxt = 'Jecheon';
                break;
                case '81':
                $cttxt = 'Se-ri';
                break;
                case '82':
                $cttxt = 'Ka-ri';
                break;
                case '83':
                $cttxt = 'Hansol';
                break;
                case '84':
                $cttxt = 'Songang';
                break;
                case '85':
                $cttxt = 'Hyangyang';
                break;
                case '86':
                $cttxt = 'Gyeongsan-si';
                break;
                case '87':
                $cttxt = 'Gumi';
                break;
                case '88':
                $cttxt = 'Unpo';
                break;
                case '89':
                $cttxt = 'Ulchin';
                break;
                case '90':
                $cttxt = 'Namhyang-dong';
                break;
                case '91':
                $cttxt = 'Taebaek';
                break;
                case '92':
                $cttxt = 'Hadong';
                break;
                case '93':
                $cttxt = 'Haesan';
                break;
                case '94':
                $cttxt = 'Chungju';
                break;
                case '95':
                $cttxt = 'Chilgok';
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





    static public function PrepareLatLong($data) {
        $data_array = array('lat'=>'0','long'=>'0');
        if (isset($data)) {
            if (isset($data['lat'])&&isset($data['long'])) {
                $data_array['lat'] = $data['lat'];
                $data_array['long'] = $data['long'];
            }
        }
        return $data_array;
    }

}
