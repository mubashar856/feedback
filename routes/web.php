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

Route::get('/teacher/{id}', 'teacherController@getTeacher');

Route::get('/admin/teachers', 'teacherController@showTeachers');

Route::get('/admin/teacher/add', 'teacherController@showAddTeacher');

Route::post('/admin/teacher/add', 'teacherController@addTeacher');

Route::get('/admin/teacher/{id}/remove', 'teacherController@removeTeacher');

Route::get('/admin/teacher/{id}/edit', 'teacherController@showEditTeacher');

Route::post('/admin/teacher/edit', 'teacherController@editTeacher');



// department routes

Route::get('/admin/departments', 'departmentController@showDepartments');

Route::get('/admin/department/add', 'departmentController@showAddDepartment');

Route::post('/admin/department/add', 'departmentController@addDepartment');

Route::get('/admin/department/{id}/remove', 'departmentController@removeDepartment');

Route::get('/admin/department/{id}/edit', 'departmentController@showEditDepartment');

Route::post('/admin/department/edit', 'departmentController@editDepartment');



// subject routes

Route::get('/teacher/subject/{subjectTeacher}', 'subjectController@getSubject');

Route::get('/admin/subjects', 'subjectController@showSubjects');

Route::get('/admin/subject/add', 'subjectController@showAddSubject');

Route::post('/admin/subject/add', 'subjectController@addSubject');

Route::get('/admin/subject/{id}/remove', 'subjectController@removeSubject');

Route::get('/admin/subject/{id}/edit', 'subjectController@showEditSubject');

Route::post('/admin/subject/edit', 'subjectController@editSubject');



// Comment routes

Route::post('/comment/add', 'commentController@addComment');

Route::get('teacher/subject/{subjectTeacher}', 'commentController@getComment');




// Admin route






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