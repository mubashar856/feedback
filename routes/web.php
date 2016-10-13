<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('index');
});



// teacher routes

Route::post('/', 'teacherController@searchTeacher');

Route::get('/teacher/add', 'teacherController@addTeacher');

Route::get('/teacher/{id}', 'teacherController@getTeacher');



// department routes

Route::get('/department/add', 'departmentController@addDepartment');




// subject routes

Route::get('/teacher/subject/{subjectTeacher}', 'subjectController@getSubject');

Route::get('/subject/add', 'subjectController@addSubject');







Route::get('test', function(){
	$searchedName = 'daud';
	$teachers = App\Models\Teacher::with('department')->where('teacher_name', 'like', '%'.$searchedName.'%')->orderBy('department_id')->get();
    
    // if ($searchedName) {

    //     $departments = $departments->whereHas('teachers', function($query) use($searchedName)
    //     {
    //         $query->where('teacher_name', 'like', '%'.$searchedName.'%');
    //     });
    // }
    // $departments = $departments->first();
	//dd(count($departments->teachers));
	foreach ($teachers as $teacher) {
		echo $teacher->teacher_name.'<br />';
	}
	//$teachers = App\Models\Teacher::with('department')->where('department_id', '1')->first();
	//dd(count($teachers->department));
	//return count($teachers->department);
});