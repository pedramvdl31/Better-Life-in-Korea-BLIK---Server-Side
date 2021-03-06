@extends($layout)
@section('stylesheets')
@stop
@section('scripts')
<script src="/assets/js/dashboard/posts/index.js"></script>
@stop

@section('content')
<input type="hidden" id="cities-autocomplete"></input>
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
				<td>{{ $avk+1 }}</td>
				<td>{{ $apv->title }}</td>
				<td>{{ $apv->date_html }}</td>
				<td><a href="{!!route('edit-post',$apv->id)!!}" class="pointer">Edit</a>/ <a class="remove-post pointer" data="{{$apv->id}}">Remove</a></td>
			</tr>

				@endforeach
			</tbody>
		</table>

	</div>
	




@stop