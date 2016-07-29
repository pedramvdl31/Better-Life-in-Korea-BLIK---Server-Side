@extends($layout)
@section('stylesheets')
    {!! Html::style('/assets/css/home/homepage.css') !!}
@stop
@section('scripts')

@stop

@section('content')
    <style type="text/css">
        .product-image-wrapper {
            height: 453px;
            border-radius: 10px;
            background: white;
            border: 1px solid #E2E1E1;
            box-shadow: 0px 0px 1px #C7C7C7;
        }
        .pr-img {
            height: 236px;
            max-height: 236px;
            background: white;
            overflow: hidden;
        }
        .single-products {
            position: relative;
            height: 410px;
            overflow: hidden;
        }
        .ad-image {
            border-top-right-radius: 10px;
            border-top-left-radius: 10px;
            height: 236px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: 50% 50%;
        }
        .infoholder{
            word-break: break-all;
        }
    </style>
    <div class="row">
        <div class="col-sm-12 ads-warps all-tabs cat-tab">
            <h2 class="title text-center">Categories</h2>
            {!!$all_categories!!}
        </div>
        <div class="col-sm-12 col-md-12 col-xs-12 home-tab ads-warps all-tabs hide">
            <div class="text-center post-loading"></div>
            <div id="post-list">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Posts</h2>
                    <div id="ads-wrapper">
                        {!!$ads['html']!!}
                    </div>
                    <div id="loading-data" style="display:none;margin:20px;">
                        <center>Loading...</center>
                    </div>
                </div><!--features_items-->
            </div>
        </div>
    </div>
@stop