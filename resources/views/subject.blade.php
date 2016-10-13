@extends('layout')

@section('title')
  Subject Profile
@endsection



@section('content')
  <div class="profile-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6">
          <div class="teacher-profile-img">
            <img src="assets/img/avatar2.png">
          </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-6">
          <div class="course-profile-bio">
            <span class="course-profile-bio-name">
              Web Engineering
            </span>
            <br />
            <span class="teacher-profile-bio-email">
              Computer Science
            </span>
            <div class="line-350"></div>
            <span class="teacher-profile-bio-department">
              Waqar Mahmood
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
      <li><a href="/teacher">Waqar Mahmood</a></li>
      <li class="active">Web Engineering</li>
    </ol>
    
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Add Comment</h3>
      </div>
      <div class="panel-body">
        <form>
          <div class="form-group">
            <label>Name (optional)</label>
            <input type="name" class="form-control" placeholder="Enter your name">
          </div>
          <div class="form-group">
            <label>Comment*</label>
            <textarea rows="3" class="form-control" placeholder="Enter comment"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Post</button>
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
          <li class="list-group-item list-group-item-default forum">
              <div class="row">
                <div class="col-md-7">
                  <div class="forum-comment">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut.
                  </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-4">
                  <div class="forum-bio">
                    <img src="assets/img/avatar1.jpg" class="forum-bio-img">
                    <div class="forum-bio-data">
                      <span class="forum-bio-data-head">By: </span>Mubashar Ahmed<br />
                      <span class="forum-bio-data-head">On: </span>Thu Oct 06, 2016 4:19 pm
                    </div>
                  </div>
                </div>
              </div>
          </li>
          <li class="list-group-item list-group-item-default forum">
              <div class="row">
                <div class="col-md-7">
                  <div class="forum-comment">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut.
                  </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-4">
                  <div class="forum-bio">
                    <img src="assets/img/avatar1.jpg" class="forum-bio-img">
                    <div class="forum-bio-data">
                      <span class="forum-bio-data-head">By: </span>Furqan Ahmed<br />
                      <span class="forum-bio-data-head">On: </span>Thu Oct 06, 2016 4:19 pm
                    </div>
                  </div>
                </div>
              </div>
          </li>
          <li class="list-group-item list-group-item-default forum">
              <div class="row">
                <div class="col-md-7">
                  <div class="forum-comment">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut.
                  </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-4">
                  <div class="forum-bio">
                    <img src="assets/img/avatar1.jpg" class="forum-bio-img">
                    <div class="forum-bio-data">
                      <span class="forum-bio-data-head">By: </span>Abdul Rehman<br />
                      <span class="forum-bio-data-head">On: </span>Thu Oct 06, 2016 4:19 pm
                    </div>
                  </div>
                </div>
              </div>
          </li>
        </ul>
      </div>
    </div>
  </div>

@endsection