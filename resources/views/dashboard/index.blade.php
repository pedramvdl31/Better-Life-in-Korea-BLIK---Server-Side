@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
@stop

@section('content')
<div class="jumbotron">
	<h1>Welcome to your dashboard</h1>
	<ol class="breadcrumb">
		<li class=""><a href="{!!route('dash_view_posts')!!}">Manage Posts</a></li>
	</ol>
</div>
@stop