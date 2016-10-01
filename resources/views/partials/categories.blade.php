<style type="text/css">
    #btcd{
        float:left;
        margin-top: 20px;         
    }
    /* Small Devices, Tablets */
    @media only screen and (max-width : 768px) {
        #btcd{
            margin-top: 0;         
        }
    }

    /* Extra Small Devices, Phones */ 
    @media only screen and (max-width : 480px) {
        #btcd{
            margin-top: 0;         
        }
    }

    /* Custom, iPhone Retina */ 
    @media only screen and (max-width : 320px) {
        #btcd{
            margin-top: 0;         
        }
    }
</style>
<div id="app-view" class="container">
    <div class="col-sm-12 ads-warps all-tabs cat-tab">
        <div id="btcd" style="">
            <a id="btc" class="btn btn-primary btn-md"><i class="glyphicon glyphicon-chevron-left"></i></a>
        </div>
        <h2 class="pages-title oswald-regular" class="title text-center">Categories</h2>
        {!!$all_categories!!}
    </div>
</div>