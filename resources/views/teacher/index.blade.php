@extends('teacher.layout')

@section('title')
    TeacherPanel
@endsection

@section('content')
    <div class="row teacher-profile-header">
        <div class="col-md-3">
            <img src="{{ asset('uploads/teacher/'. $teacher->teacher_picture) }}" width="200">
        </div>
        <div class="col-md-5">
            <ul class="teacher-detail-group">
                <li><span class="heading">Name: </span> {{ $teacher->teacher_name }}</li>
                <li><span class="heading">Email: </span>{{ $teacher->teacher_email }}</li>
                <li><span class="heading">Department: </span>{{ $teacher->department->department_name }}</li>
            </ul>
        </div>
    </div>
    <hr />
    <div class="teacher-subjects">
        <h2>Assigned Subjects</h2>
        <div class="row">
            @foreach($subjectTeachers as $subjectTeacher)
                <div class="col-md-3">
                    <a href="/teacher/subject/{{ $subjectTeacher->id }}">{{  $subjectTeacher->semester->semester_name.'->'.$subjectTeacher->subject->subject_name }}</a><br />
                </div>
            @endforeach
        </div>
    </div>
@endsection