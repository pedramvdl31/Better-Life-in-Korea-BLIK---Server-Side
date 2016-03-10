@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
<script src="/assets/js/dashboard/posts/index.js"></script>
@stop

@section('content')



<div class="jumbotron">
	<h1>Posts</h1>
	<ol class="breadcrumb">
		<li class="active">Posts Overview</li>
	</ol>
</div>
<div class="table-responsive">
	<table id="inventory_table" class="table table-striped table-bordered table-hover table-responsive">
		<thead>
			<tr>
				<th>No</th>
				<th>Title</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="inventory_table_body">
			@foreach($all_posts as $avk => $apv)
			<tr>
				<td>{{ $avk }}</td>
				<td>{{ $apv->title }}</td>
				<td>{{ $apv->date_html }}</td>
				<td><a href="{!!route('edit-post',$apv->id)!!}" class="pointer">Edit</a>/ <a class="remove-post pointer" data="{{$apv->id}}">Remove</a></td>
			</tr>

				@endforeach
			</tbody>
		</table>

	</div>
	




@stop