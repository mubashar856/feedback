@extends('admin.layout')

@section('title')
    admin | add Semester
@endsection

@section('content')

    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <h3>Add Semester</h3>
            @if(count($errors))
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{ $error  }}<br />
                    @endforeach
                </div>
            @endif
            @if(\Session::has('success'))
                <div class="alert alert-success"><b>Hey Admin: </b> {{ \Session::get('success') }}</div>
            @endif
            <form method="post" action="/admin/semester/add">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group">
                    <label for="semesterName">Semester's Name</label>
                    <input type="text" class="form-control" name="semester_name" id="semesterName" placeholder="Enter semester name">
                </div>
                <button type="submit" class="btn btn-primary">Add semester</button>
            </form>

        </div>
    </div>

@endsection