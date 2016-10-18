@extends('admin.layout')

@section('title')
	Admin | show departments
@endsection




@section('content')
	
	@if(\Session::has('success'))
        <div class="alert alert-success"><b>Hey Admin: </b>{{\Session::get('success')}} <span class="glyphicon glyphicon-thumbs-up"></span></div>
    @elseif(\Session::has('danger'))
    	<div class="alert alert-danger"><b>Hey Admin: </b>{{\Session::get('success')}} </div>
    @endif	

	<table id="dataTables" class="table table-bordered display" cellspacing="0" width="100%" style="background-color: #fff;">
		<thead>
			<tr>
				<th colspan="5">
					All Departments
				</th>
			</tr>
			<tr>
				<th>
					department Name
				</th>
				<th>
					Update
				</th>
			</tr>
		</thead>
		<tbody>
			@if(count($departments))
				@foreach($departments as $department)
					<tr>
						<td>{{ $department->department_name }}</td>
						<td>
							<div class="btn-group" role="group">
							  <a href="/admin/department/{{ $department->id }}/edit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Department">
							  	<span class="glyphicon glyphicon-edit"></span>
							  </a>
							  <a href="/admin/department/{{ $department->id }}/remove" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Remove Department">
							  	<span class="glyphicon glyphicon-remove"></span>
							  </a>
							</div>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="5">
						<div class="alert alert-info">No department added yet. <a href="/admin/department/add">Click here</a> to add one</div>	
					</td>
				</tr>
			@endif
		</tbody>
	</table>

@endsection



@section('desiredCss')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
@endsection

@section('desiredJs')
	<script type="text/javascript" src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#dataTables').DataTable();
		} );
	</script>

@endsection