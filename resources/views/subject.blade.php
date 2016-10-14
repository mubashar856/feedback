@extends('layout')

@section('title')
  {{ $subjectTeacher->subject->subject_name }}
@endsection



@section('content')
  <div class="profile-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6">
          <div class="teacher-profile-img" style="background-image: url(../../assets/img/{{ $subjectTeacher->subject->subject_logo }});">
          </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-6">
          <div class="course-profile-bio">
            <span class="course-profile-bio-name">
              {{ $subjectTeacher->subject->subject_name }}
            </span>
            <br />
            <span class="teacher-profile-bio-email">
              {{ $subjectTeacher->teacher->department->department_name }}
            </span>
            <div class="line-350"></div>
            <span class="teacher-profile-bio-department">
              {{ $subjectTeacher->teacher->teacher_name }}
            </span>
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
      <li><a href="/teacher/{{ $subjectTeacher->teacher_id }}">{{ $subjectTeacher->teacher->teacher_name }}</a></li>
      <li class="active">{{ $subjectTeacher->subject->subject_name }}</li>
    </ol>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br />
            @endforeach
        </div>
    @endif
    @if(\Session::has('success'))
      <div class="alert alert-success"><b>Yeahhhhh: </b>{{\Session::get('success')}} <span class="glyphicon glyphicon-thumbs-up"></span></div>
    @endif
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Add Comment</h3>
      </div>
      <div class="panel-body">
        <form method="post" action="/comment/add">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="subject_teacher_id" value="{{ $subjectTeacher->id }}">
          <div class="form-group">
            <label>Name (optional)</label>
            <input type="name" name="user_name" class="form-control" placeholder="Enter your name">
          </div>
          <div class="form-group">
            <label>Comment*</label>
            <textarea rows="3" name="comment" class="form-control" placeholder="Enter comment"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
      </div>
    </div>

    <br />
    
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Course Forum</h3>
      </div>
      <div class="panel-body">
        <ul class="list-group">
          @if(count($subjectTeacher->comments))
            @foreach($subjectTeacher->comments as $comment)
              <li class="list-group-item list-group-item-default forum">
                  <div class="row">
                    <div class="col-md-7">
                      <div class="forum-comment">
                        {{ $comment->comment }}
                      </div>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-4">
                      <div class="forum-bio">
                        <img src="../../assets/img/avatar2.png" class="forum-bio-img">
                        <div class="forum-bio-data">
                          <span class="forum-bio-data-head">By: </span>{{ $comment->user_name }}<br />
                          <span class="forum-bio-data-head">On: </span>{{ $comment->created_at }}
                        </div>
                      </div>
                    </div>
                  </div>
              </li>
            @endforeach
          @else
            <div class="alert alert-danger">No one yet commented on this post. Be first to comment :)</div>

          @endif
        </ul>
      </div>
    </div>
  </div>

@endsection