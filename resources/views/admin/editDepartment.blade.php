@extends('admin.layout')

@section('title')
	admin | edit Department
@endsection





@section('content')
	<div class="row">
        <div class="col-md-offset-3 col-md-6">
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
                <input type="hidden" name="department_id" value="{{ $department->id }}">
                @include('partials.departmentFields')
            </form>
        </div>
    </div>
@endsection