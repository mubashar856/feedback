@extends('admin.layout')

@section('title')
	{{ $subject->subject_name }} | Profile
@endsection




@section('content')
	
	

	@if(\Session::has('success'))
        <div class="alert alert-success"><b>Hey Admin: </b>{{\Session::get('success')}} <span class="glyphicon glyphicon-thumbs-up"></span></div>
    @elseif(\Session::has('danger'))
    	<div class="alert alert-danger"><b>Hey Admin: </b>{{\Session::get('success')}} </div>
    @endif	
		

    <div class="row">
    	<div class="col-md-4">
    		<img src="{{ asset('uploads/subject/'.$subject->subject_logo) }}" class="subject-teacher-logo">
    	</div>
    	<div class="col-md-4">
    		<h2>{{ $subject->subject_name }}</h2>
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
    		<h3>Assign teacher to this subject</h3>
		    <form method="post" action="/subject/teacher/add">
		    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		    	<input type="hidden" name="subject_id" value="{{ $subject->id }}">
				<div class="form-group">
					<label for="semesters">Select Semester</label>
					<select name="semester_id" id="semesters" class="form-control">
						@foreach($semesters as $semester)
							<option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="teachers">Select Teacher</label>
					<select name="teacher_id" id="teachers" class="form-control">
			    		@foreach($teachers as $teacher)
			    			<option value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
			    		@endforeach
			    	</select>
				</div>
		    	<input type="submit" class="btn btn-primary" value="Assign subject">
		    </form>	
    	</div>
    	<div class="col-md-6">
    		<h3>Assigned teachers to this subject</h3>
			@if(count($subject->subjectTeachers))
				<ul class="list-group">
			    	@foreach($subject->subjectTeachers as $subjectTeacher)
			    		<li class="list-group-item">
							{{ $subjectTeacher->semester->semester_name }} ->
			    			<a href="/admin/teacher/{{ $subjectTeacher->teacher_id }}">{{ $subjectTeacher->teacher->teacher_name }}</a>
			    			<a href="/subject/teacher/{{ $subjectTeacher->id }}/remove" style="float: right;">
			    				<span class="glyphicon glyphicon-remove"></span>
			    			</a>
			    		</li>
			    	@endforeach
		    	</ul>
		    @else
		    	<div class="alert alert-danger">no teacher found</div>
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