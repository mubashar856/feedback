@extends('layout')

@section('title')
  {{ $results->teacher_name }}
@endsection



@section('content')

  <div class="profile-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6">
          <div class="teacher-profile-img" style="background-image: url('{{ asset('/uploads/teacher/'.$results->teacher_picture)}}');">
          </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-6">
          <div class="teacher-profile-bio">
            <span class="teacher-profile-bio-name">
              {{ $results->teacher_name }}
            </span>
            <span class="teacher-profile-bio-department">
              [ {{ $results->department->department_name }} ]
            </span><br />
            <span class="teacher-profile-bio-email">
              {{ $results->teacher_email }}
            </span>
            <div class="line-350"></div>
            <div class="teacher-bio">
              {{ $results->teacher_information }}
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="teacher-profile-chart">
            <img src="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <br />
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="/">Home</a></li>
      <li class="active">{{ $results->teacher_name }}</li>
    </ol>
    
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Courses</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          @if(count($results->subjects))
            @foreach($results->subjects as $subject)
              <div class="col-lg-3 col-md-3 col-sm-4">
                <a href="/teacher/subject/{{ $subject->pivot->id }}" class="course">{{ $subject->subject_name }}</a>
              </div>
            @endforeach
          @else
            <div class="alert alert-info">No subject found</div>
          @endif
        </div>
      </div>
    </div>
  </div>

@endsection