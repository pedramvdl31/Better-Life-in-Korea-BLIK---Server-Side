@extends($layout)
@section('stylesheets')
      {!! Html::style('/assets/css/home/homepage.css') !!}
@stop
@section('scripts')
@stop

@section('content')
<style type="text/css">
.product-image-wrapper {
    height: 404px;
}
.pr-img {
    height: 236px;
    max-height: 236px;
    background: #F3F3F3;
    overflow: hidden;
}
.single-products {
    position: relative;
    height: 363px;
    overflow: hidden;
}
</style>
	<div class="features_items"><!--features_items-->
		<h2 class="title text-center">Features Items</h2>
		{!!$ads['html']!!}
	</div><!--features_items-->
	<div class="text-center">
		<?php echo $ads['data']->render(); ?>
	</div>
	
@stop