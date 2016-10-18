@extends('admin.layout')

@section('title')
	{{ $teacher->teacher_name }} | Profile
@endsection




@section('content')
	
	

	@if(\Session::has('success'))
        <div class="alert alert-success"><b>Hey Admin: </b>{{\Session::get('success')}} <span class="glyphicon glyphicon-thumbs-up"></span></div>
    @elseif(\Session::has('danger'))
    	<div class="alert alert-danger"><b>Hey Admin: </b>{{\Session::get('success')}} </div>
    @endif	
		

    <div class="row">
    	<div class="col-md-4">
    		<img src="{{ asset('uploads/teacher/'.$teacher->teacher_picture) }}" class="subject-teacher-logo">
    	</div>
    	<div class="col-md-4">
    		<h2>{{ $teacher->teacher_name }}</h2>
    		<h4>{{ $teacher->department->department_name }}</h4>
    	</div>
    	<div class="col-md-4"></div>
    </div>

    <hr />
    

    @if(count($errors))
    	<div class="alert alert-danger">
	    	@foreach($errors->all() as $error)
	    		{{ $error }}<br />
	    	@endforeach
    	</div>
    @endif

    <div class="row">
    	<div class="col-md-6">
    		<h3>Assign subject to this teacher</h3>
		    <form method="post" action="/subject/teacher/add">
		    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		    	<input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
				<div class="form-group">
					<label for="subjects">Select Subject</label>
					<select name="subject_id" id="subjects" class="form-control">
			    		@foreach($subjects as $subject)
			    			<option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
			    		@endforeach
			    	</select>
				</div>
		    	<input type="submit" class="btn btn-primary" value="Assign subject">
		    </form>	
    	</div>
    	<div class="col-md-6">
    		<h3>Assigned subjects to this teacher</h3>
			@if(count($teacher->subjects))
				<ul class="list-group">
			    	@foreach($teacher->subjects as $subject)
			    		<li class="list-group-item">
			    			{{ $subject->subject_name }}
			    			<a href="/subject/teacher/{{ $subject->pivot->id }}/remove" style="float: right;">
			    				<span class="glyphicon glyphicon-remove"></span>
			    			</a>
			    		</li>
			    	@endforeach
		    	</ul>
		    @else
		    	<div class="alert alert-danger">no subject found</div>
		    @endif    		
    	</div>
    </div>


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