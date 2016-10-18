@extends('admin.layout')

@section('title')
	admin | add Subject
@endsection





@section('content')
	
	<h2>Add Subject</h2>
	@if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br />
            @endforeach
        </div>
    @endif
    @if(\Session::has('success'))
      <div class="alert alert-success"><b>Hey Admin: </b>{{\Session::get('success')}} <span class="glyphicon glyphicon-thumbs-up"></span></div>
    @endif
	<form method="post" action="/admin/subject/add" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="subjectName">Subject's Name</label>
			<input type="text" name="subject_name" class="form-control" id="subjectName" placeholder="Enter subject name">
		</div>
		<div class="form-group">
			<label for="subjectLogo">Subject's logo</label>
			<input type="file" name="subject_logo" class="form-control" id="subjectLogo">
		</div>
		<button type="submit" class="btn btn-primary">Add subject</button>
	</form>
	
@endsection