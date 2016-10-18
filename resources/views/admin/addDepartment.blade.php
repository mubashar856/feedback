@extends('admin.layout')

@section('title')
	admin | add Department
@endsection





@section('content')
	
	<h2>Add Department</h2>
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
	<form method="post" action="/admin/department/add" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="departmentName">Department's Name</label>
			<input type="text" name="department_name" class="form-control" id="departmentName" placeholder="Enter department name">
		</div>
		<div class="form-group">
			<label for="departmentLogo">Department's logo</label>
			<input type="file" name="department_logo" class="form-control" id="departmentLogo">
		</div>
		<button type="submit" class="btn btn-primary">Add department</button>
	</form>
	
@endsection