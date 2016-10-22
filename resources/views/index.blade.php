@extends('layout')

@section('title')
    Feedback System
@endsection



@section('content')

    <div class="main-header">
        <div class="main-header-inner">
            <div class="search-header">
                <h1 class="main-search-heading animated">Search Teacher</h1>
                <div class="search-box animated">
                    <form method="post" action="/">
                        <input type="text" name="teacher_name" class="search-field" placeholder="Teacher name">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="search-btn">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br />
    <div class="container">
        <ol class="breadcrumb">
            <li class="active">Home</li>
        </ol>


        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Search Results</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    @if(isset($teachers))
                        @if(count($teachers))
                            @foreach($teachers as $teacher)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="teacher-result">
                                        <div class="teacher-result-outer">
                                            <div class="teacher-result-inner">
                                                <img src="{{ asset('uploads/teacher/'. $teacher->teacher_picture) }}" class="teacher-search-img"><br /><br />
                                                <span class="teacher-search-name">
                                                    {{ $teacher->teacher_name }}
                                                </span><br />
                                                <span class="department-search-name">
                                                    {{ $teacher->department->department_name }}
                                                </span><br />
                                                <a href="/teacher/{{ $teacher->slug }}" class="teacher-search-visit">profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-warning"><b>Warning! </b>No Result found.</div>
                        @endif

                    @else
                        <div class="alert alert-info"><b>Hey Listen: </b>Enter the name of the teacher in above field to search.</div>
                    @endif
                </div><!-- row class end -->

            </div>
        </div><!-- panel end -->

    </div>

@endsection


@section('customJs')
    <script>
        $(document).ready(function(){
            $('.search-box').mouseenter(function(){
                $('.main-search-heading').addClass('fadeOutUp');
                $('.main-search-heading').removeClass('fadeInDown');
            });
            $('.search-box').mouseleave(function(){
                $('.main-search-heading').removeClass('fadeOutUp');
                $('.main-search-heading').addClass('fadeInDown');
            });
        });

    </script>
@endsection