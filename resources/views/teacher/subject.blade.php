@extends('teacher.layout')

@section('title')
    TeacherPanel
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('uploads/subject/'. $subjectTeacher->subject->subject_logo) }}" width="200">
        </div>
        <div class="col-md-4">
            {{ $subjectTeacher->subject->subject_name }}<br />
            {{ $subjectTeacher->teacher->teacher_name }}<br />
            {{ $subjectTeacher->teacher->department->department_name }}

        </div>
    </div>
    <hr />
    <ul>
    @foreach($subjectTeacher->comments as $comment)
        <li>{{ $comment->comment }} <b>By:</b> {{ $comment->user_name }}</li>
    @endforeach
    </ul>
@endsection