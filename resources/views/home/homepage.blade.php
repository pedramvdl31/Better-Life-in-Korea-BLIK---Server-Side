@extends($layout)
@section('stylesheets')
      {!! Html::style('/assets/css/home/homepage.css') !!}
@stop
@section('scripts')
@stop

@section('content')
<style type="text/css">
.product-image-wrapper {
    height: 425px;
}
.pr-img {
    height: 236px;
    max-height: 236px;
    background: white;
    overflow: hidden;
}
.single-products {
    position: relative;
    height: 385px;
    overflow: hidden;
}
</style>
	<div class="features_items"><!--features_items-->
		<h2 class="title text-center">Posts</h2>
        <div id="ads-wrapper">
            {!!$ads['html']!!}
        </div>
	</div><!--features_items-->
	<div class="text-center" id="pagi">
		{!!$ads['data']->render()!!}
	</div>
	
@stop