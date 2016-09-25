<div id="app-view" class="container">
    <div class="col-sm-12 ads-warps all-tabs cat-tab">
        <div style="float:left;margin-top: 20px;">
            <a id="btc" class="btn btn-primary btn-md"><i class="glyphicon glyphicon-chevron-left"></i></a>
        </div>
        <h2 class="pages-title oswald-regular" class="title text-center">Categories</h2>
        {!!$all_categories!!}
    </div>
    <div id="posts-page" class="col-sm-12 col-md-12 col-xs-12 home-tab ads-warps all-tabs hide">
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
                <div id="no-ads" style="display:none;">
                    <center><p>We ran out of posts :/</p></center>
                </div>
            </div><!--features_items-->
        </div>
    </div>
</div>