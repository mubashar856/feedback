@extends('teacher.layout')

@section('title')
    TeacherPanel
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('uploads/teacher/'. $teacher->teacher_picture) }}" width="200">
        </div>
        <div class="col-md-4">
            {{ $teacher->teacher_name }}<br />
            {{ $teacher->teacher_email }}<br />
            {{ $teacher->department->department_name }}

        </div>
    </div>
    <hr />
    @foreach($subjectTeachers as $subjectTeacher)
        <a href="/teacher/subject/{{ $subjectTeacher->id }}">{{  $subjectTeacher->semester->semester_name.'->'.$subjectTeacher->subject->subject_name }}</a><br />
    @endforeach
@endsection