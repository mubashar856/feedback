@extends('teacher.layout')

@section('title')
    TeacherPanel
@endsection

@section('content')
    <div class="row teacher-profile-header">
        <div class="col-md-3">
            <img src="{{ asset('uploads/subject/'. $subjectTeacher->subject->subject_logo) }}" width="200">
        </div>
        <div class="col-md-5">
            <ul class="teacher-detail-group">
                <li><span class="heading">Name: </span> {{ $subjectTeacher->subject->subject_name }}</li>
                <li><span class="heading">Teacher Name: </span> {{ $subjectTeacher->teacher->teacher_name }}</li>
                <li><span class="heading">Department: </span> {{ $subjectTeacher->teacher->department->department_name }}</li>
            </ul>
        </div>
    </div>
    <hr />
    <div class="teacher-profile-subject-comments">
        <h2>Comments</h2>
        <ul>
            @if(count($subjectTeacher->comments))
                @foreach($subjectTeacher->comments as $comment)
                    <li>{{ $comment->comment }} <span class="sender-name"><b>By:</b> {{ $comment->user_name }} | <b>On: </b> {{ $comment->created_at }}</span></li>
                @endforeach
            @else
                <div class="alert alert-info">No one commented on this subject yet</div>
            @endif
        </ul>
    </div>
@endsection