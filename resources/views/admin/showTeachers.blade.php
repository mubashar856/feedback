@extends('admin.layout')

@section('title')
	Admin | show teacher
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
					All Teachers
				</th>
			</tr>
			<tr>
				<th>
					Teacher Name
				</th>
				<th>
					Department
				</th>
				<th colspan="2">
					Subjects
				</th>
				<th>
					Update
				</th>
			</tr>
			<tr>
				<th>
					
				</th>
				<th>
					
				</th>
				<th>
					Show Subjects
				</th>
				<th>
					Add/Remove Subjects
				</th>
				<th>
					
				</th>
			</tr>
		</thead>
		<tbody>
			@if(count($teachers))
				@foreach($teachers as $teacher)
					<tr>
						<td><a href="/admin/teacher/{{ $teacher->id }}" style="display: block;">{{ $teacher->teacher_name }}</a></td>
						<td>{{ $teacher->department->department_name }}</td>
						<td>
							@if(count($teacher->subjects))
								@foreach($teacher->subjects as $subject)
									{{ $subject->subject_name }}, 
								@endforeach
							@else
								No Subject found
							@endif
						</td>
						<td><a href="/admin/teacher/{{ $teacher->id }}" class="btn btn-primary btn-sm">Add/Remove</a></td>
						<td>
							<div class="btn-group" role="group">
							  <a href="/admin/teacher/{{ $teacher->id }}/edit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Teacher">
							  	<span class="glyphicon glyphicon-edit"></span>
							  </a>
							  <a href="/admin/teacher/{{ $teacher->id }}/remove" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Remove Teacher">
							  	<span class="glyphicon glyphicon-remove"></span>
							  </a>
							</div>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="5">
						<div class="alert alert-info">No teacher added yet. <a href="/admin/teacher/add">Click here</a> to add one</div>	
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