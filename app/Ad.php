<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

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
                ->paginate(9);

            if (isset($ads)) {
                $output = Ad::PrepareAdsForHome($ads);
            }
        }

        return $output;
    }
    static public function PrepareAdsSearchCategory($cat_id,$subcat_id) {
        $output = null;
        $ads = Ad::where('status',1)->where('cat_id',$cat_id)->where('subcat_id',$subcat_id)->paginate(9);
        if (isset($ads)) {
            $output = Ad::PrepareAdsForHome($ads);
        }
        return $output;
    }
    static public function PrepareAdsForHome($data) {

        $data_a = array();
        $data_a['html'] = '';
        $data_a['data'] = $data;
        if (isset($data)) {
            foreach ($data as $dk => $dv) {
                $new_t = '';
                $new_des = '';
                if (isset($dv['title'])) {
                    $t_temp = $dv['title'];
                    $new_t = strlen($t_temp)>15?substr($t_temp,0,15)."...":$t_temp;
                }
                if (isset($dv['description'])) {
                    $des_temp = json_decode($dv['description']);
                    $new_des = strlen($des_temp)>50?substr($des_temp,0,50)."...":$des_temp;
                }

                $f_image = DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'home'.DIRECTORY_SEPARATOR.'product1.jpg';
                $poster_id = $dv['user_id'];
                if (isset($dv['file_srcs'])) {

                    $src_temp = json_decode($dv['file_srcs'],true);
                    if (isset($src_temp['0']['image']['name'])) {
                        $un_path = 'assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$poster_id.DIRECTORY_SEPARATOR.'prm'.DIRECTORY_SEPARATOR.'image'.DIRECTORY_SEPARATOR.$src_temp['0']['image']['name'];
                        if (file_exists($un_path)) {
                            $f_image = $un_path;
                        }    
                    }
                }
                $data_a['html'] .= '
                        <div class="col-md-4 col-sm-6 col-xs-12 ">
                            <div class="product-image-wrapper">
                                <div class="single-products view-ad pointer" data="'.$dv->id.'">
                                    <div class="productinfo text-center">
                                        <div class="pr-img">
                                            <img src="'.$f_image.'" alt="" />
                                        </div>
                                        <h2>'.$new_t.'</h2>
                                        <p>'.$new_des.'</p>
                                    </div>
                                    <div class="product-overlay">
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a data="'.$dv->id.'" class="add-to-wishlist pointer"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
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
        $html = "";
        if (isset($data)) {
            if (isset($data['description'])) {
               $des =  json_decode($data['description']);
            }
            $username = '';
            if ($data['user_id']) {
                $this_user_id = $data['user_id'];
                if (isset($this_user_id)) {
                    $user = User::find($this_user_id);
                    if (isset($user)) {
                        $username = $user->email;
                    }
                }
            }
            $html .= "  <dl>
                          <dt>By:</dt>
                          <dd>".$username."</dd>
                          <dt>Title</dt>
                          <dd>".$data->title."</dd>
                          <dt>Description</dt>
                          <dd>".json_decode($data['description'])."</dd>
                        </dl>
                        <hr>
                        ";
            if (isset($data['file_srcs']) && $data['file_srcs'] != 'null') {
                $files = json_decode($data['file_srcs'],true);
                $base_path = DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'posts'.DIRECTORY_SEPARATOR.$data['user_id'].DIRECTORY_SEPARATOR.'prm'.DIRECTORY_SEPARATOR;
                foreach ($files as $fk => $fv) {
                    foreach ($fv as $fvk => $fvv) {
                        if ($fvk=="image") {
                            $html .= '
                              <div class="col-xs-12 col-md-12 thumb-wrap">
                                <div href="#" class="thumbnail">
                                  <img src="'.$base_path.$fvk.DIRECTORY_SEPARATOR.$fvv['name'].'" alt="...">
                                </div>
                              </div>
                            ';
                        } elseif ($fvk=="video") {

                            $html .= '
                              <div class="col-xs-12 col-md-12 thumb-wrap">
                                <div href="#" class="thumbnail">
                                    <div class="flex-video widescreen ">
                                        <video class="" frameborder="0" controls>
                                            <source src="'.$base_path.$fvk.DIRECTORY_SEPARATOR.$fvv['name'].'" type="video/mp4">
                                        </video>
                                    </div>   
                                </div>
                              </div>
                            ';



                        }
                    }
                }
            }
        }
        return $html;
    }

}
