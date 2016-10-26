@extends('teacher.layout')

@section('title')
    TeacherPanel
@endsection

@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            @if(count($errors))
                <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{ $error }}<br />
                @endforeach
                </div>
            @endif
                @if(\Session::has('success'))
                    <div class="alert alert-success">{{\Session::get('success')}} <span class="glyphicon glyphicon-thumbs-up"></span></div>
                @elseif(\Session::has('error'))
                    <div class="alert alert-danger">{{\Session::get('error')}}</div>
                @endif
            <h1>Change password</h1>
            <form method="POST" action="{{ url('/teacher/profile/update/password/') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group">
                    <label for="oldPassword">Enter Old Password</label>
                    <input type="password" name="old_password" class="form-control" id="oldPassword" />
                </div>
                <div class="form-group">
                    <label for="password">Enter New Password</label>
                    <input type="password" name="password" class="form-control" id="password"/>
                </div>
                <div class="form-group">
                    <label for="passwordConfirmation">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmation"/>
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
@endsection