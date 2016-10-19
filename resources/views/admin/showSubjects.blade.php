@extends('admin.layout')

@section('title')
	Admin | show Subjects
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
					All Subjects
				</th>
			</tr>
			<tr>
				<th>
					Subject Name
				</th>
				<th>
					Show Teachers
				</th>
				<th>
					Add/Remove Teacher
				</th>
				<th>
					Update
				</th>
			</tr>
		</thead>
		<tbody>
			@if(count($subjects))
				@foreach($subjects as $subject)
					<tr>
						<td><a href="/admin/subject/{{ $subject->id }}" style="display: block;">{{ $subject->subject_name }}</a></td>
						<td>
							@if(count($subject->teachers))
								@foreach($subject->teachers as $teacher)
									<a href="/admin/teacher/{{ $teacher->id }}">{{ $teacher->teacher_name }}</a>, 
								@endforeach
							@else
								No Teacher found
							@endif
						</td>
						<td><a href="/admin/subject/{{ $subject->id }}" class="btn btn-primary btn-sm">Add/Remove</a></td>
						<td>
							<div class="btn-group" role="group">
							  <a href="/admin/subject/{{ $subject->id }}/edit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Subject">
							  	<span class="glyphicon glyphicon-edit"></span>
							  </a>
							  <a href="/admin/subject/{{ $subject->id }}/remove" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Remove Subject">
							  	<span class="glyphicon glyphicon-remove"></span>
							  </a>
							</div>
						</td>
					</tr>
				@endforeach
			@else
				<tr>
					<td colspan="5">
						<div class="alert alert-info">No subject added yet. <a href="/admin/subject/add">Click here</a> to add one</div>	
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