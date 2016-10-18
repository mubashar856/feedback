@extends('admin.layout')

@section('title')
	admin | edit Teacher
@endsection





@section('content')
	
	<h2>Edit Teacher ({{ $teacher->teacher_name }})</h2>
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
	<form method="post" action="/admin/teacher/edit" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
		<div class="form-group">
			<label for="teacherName">Teacher's Name</label>
			<input type="text" name="teacher_name" class="form-control" id="teacherName" placeholder="Enter teacher name" value="{{ $teacher->teacher_name }}">
		</div>
		<div class="form-group">
			<label for="teacherEmail">Teacher's Email</label>
			<input type="email" name="teacher_email" class="form-control" id="teacherEmail" placeholder="Enter teacher email address" value="{{ $teacher->teacher_email }}">
		</div>
		<div class="form-group">
			<label for="teacherPicture">Teacher's Picture</label>
			<input type="file" name="teacher_picture" class="form-control" id="teacherPicture">
			<p class="help-block">leave this field empty if you do not want to change teacher's picture</p>
		</div>
		<div class="form-group">
			<label for="teacherInformation">Teacher's Information</label>
			<textarea name="teacher_information" class="form-control" rows="3" id="teacherInformation">{{ $teacher->teacher_information }}</textarea>
		</div>
		<button type="submit" class="btn btn-primary">Edit teacher</button>
	</form>
	
@endsection