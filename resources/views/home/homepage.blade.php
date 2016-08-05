@extends($layout)
@section('stylesheets')
    {!! Html::style('/assets/css/home/homepage.css') !!}
@stop
@section('scripts')

@stop

@section('content')
    <div id="app-view" class="container">
        <div class="col-sm-12 ads-warps all-tabs cat-tab">
            <h2 class="pages-title oswald-regular" class="title text-center">Categories</h2>
            {!!$all_categories!!}
        </div>
        <div class="col-sm-12 col-md-12 col-xs-12 home-tab ads-warps all-tabs hide">
            <div class="text-center post-loading"></div>
            <div id="post-list">
                <div class="features_items"><!--features_items-->
                    <h2 class="pages-title" class="title text-center">Posts</h2>
                    <div id="ads-wrapper">
                        {!!$ads['html']!!}
                    </div>
                    <div id="loading-data" style="display:none;">
                        <center><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></center>
                    </div>
                </div><!--features_items-->
            </div>
        </div>
    </div>
@stop