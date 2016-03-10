<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Ad extends Model
{
    

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
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <div class="pr-img">
                                                <img src="'.$f_image.'" alt="" />
                                            </div>
                                            <h2>'.$new_t.'</h2>
                                            <p>'.$new_des.'</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>$56</h2>
                                                <p>Easy Polo Black Edition</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View</a>
                                            </div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
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


}
