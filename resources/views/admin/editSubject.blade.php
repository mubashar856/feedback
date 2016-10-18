@extends('admin.layout')

@section('title')
	admin | edit Subject
@endsection





@section('content')
	
	<h2>Edit Subject ({{ $subject->subject_name }})</h2>
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
	<form method="post" action="/admin/subject/edit" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="subject_id" value="{{ $subject->id }}">
		<div class="form-group">
			<label for="subjectName">Subject's Name</label>
			<input type="text" name="subject_name" class="form-control" id="subjectName" placeholder="Enter subject name" value="{{ $subject->subject_name }}">
		</div>
		<div class="form-group">
			<label for="subjectLogo">Subject's logo</label>
			<input type="file" name="subject_logo" class="form-control" id="subjectLogo">
			<p class="help-block">leave this field empty if you do not want to change logo</p>
		</div>
		<button type="submit" class="btn btn-primary">Edit subject</button>
	</form>
	
@endsection