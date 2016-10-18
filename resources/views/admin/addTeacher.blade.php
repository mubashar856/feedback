@extends('admin.layout')

@section('title')
	admin | add Teacher
@endsection





@section('content')
	<div class="row">
		<div class="col-md-offset-3 col-md-6">
			<h2>Add Teacher</h2>
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
			<form method="post" action="/admin/teacher/add" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="teacherName">Teacher's Name</label>
					<input type="text" name="teacher_name" class="form-control" id="teacherName" placeholder="Enter teacher name">
				</div>
				<div class="form-group">
					<label for="teacherEmail">Teacher's Email</label>
					<input type="email" name="teacher_email" class="form-control" id="teacherEmail" placeholder="Enter teacher email address">
				</div>
				<div class="form-group">
					<label for="teacherDepartment">Teacher's Department</label>
					<select name="department_id" class="form-control" id="teacherDepartment">
						@if(count($departments))
							@foreach($departments as $department)
								<option value="{{ $department->id }}">{{ $department->department_name }}</option>
							@endforeach
						@else
							<option value="0">No department found</option>
						@endif
					</select>
					<p class="help-block">Be careful, Department cannot be changed in furture.</p>
				</div>
				<div class="form-group">
					<label for="teacherPicture">Teacher's Picture</label>
					<input type="file" name="teacher_picture" class="form-control" id="teacherPicture">
				</div>
				<div class="form-group">
					<label for="teacherInformation">Teacher's Information</label>
					<textarea name="teacher_information" class="form-control" rows="3" id="teacherInformation"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Add teacher</button>
			</form>
		</div>
	</div>
	
@endsection