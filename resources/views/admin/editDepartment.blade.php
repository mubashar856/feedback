@extends('admin.layout')

@section('title')
	admin | edit Department
@endsection





@section('content')
	
	<h2>Edit Department ({{ $department->department_name }})</h2>
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
	<form method="post" action="/admin/department/edit" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="department_id" value="{{ $department->id }}">
		<div class="form-group">
			<label for="departmentName">Department's Name</label>
			<input type="text" name="department_name" class="form-control" id="departmentName" placeholder="Enter department name" value="{{ $department->department_name }}">
		</div>
		<div class="form-group">
			<label for="departmentLogo">Department's logo</label>
			<input type="file" name="department_logo" class="form-control" id="departmentLogo">
			<p class="help-block">leave this field empty if you do not want to change logo</p>
		</div>
		<button type="submit" class="btn btn-primary">Update department</button>
	</form>
	
@endsection