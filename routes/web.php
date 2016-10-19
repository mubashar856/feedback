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

Route::post('/teacher/subject/add', 'teacherController@addTeacherSubject');

Route::get('/teacher/subject/{id}/remove', 'teacherController@removeTeacherSubject');


// department routes
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function ()
{
	Route::get('departments', 'departmentController@showDepartments');

	Route::get('department/add', 'departmentController@showAddDepartment');

	Route::post('department/add', 'departmentController@addDepartment');

	Route::get('department/{id}/remove', 'departmentController@removeDepartment');

	Route::get('department/{id}/edit', 'departmentController@showEditDepartment');

	Route::post('department/edit', 'departmentController@editDepartment');	

	Route::get('teachers', 'teacherController@showTeachers');

	Route::get('teacher/add', 'teacherController@showAddTeacher');

	Route::post('teacher/add', 'teacherController@addTeacher');

	Route::get('teacher/{id}/remove', 'teacherController@removeTeacher');

	Route::get('teacher/{id}/edit', 'teacherController@showEditTeacher');

	Route::post('teacher/edit', 'teacherController@editTeacher');

	Route::get('teacher/{id}', 'teacherController@showTeacherProfile');

	Route::get('subjects', 'subjectController@showSubjects');

	Route::get('subject/add', 'subjectController@showAddSubject');

	Route::post('subject/add', 'subjectController@addSubject');

	Route::get('subject/{id}/remove', 'subjectController@removeSubject');

	Route::get('subject/{id}/edit', 'subjectController@showEditSubject');

	Route::post('subject/edit', 'subjectController@editSubject');

	Route::get('subject/{id}', 'subjectController@showSubjectProfile');

	Route::get('logout', 'adminController@logout');

	Route::get('semester/add', 'semesterController@showAddSemester');

	Route::post('semester/add', 'semesterController@addSemester');

	Route::get('semesters', 'semesterController@showSemesters');

	Route::get('semester/{semester}/new-status/{status}', 'semesterController@changeStatus');

	Route::get('/', function (){
        return view('admin.index');
    });
});


Route::get('/profile/department/{id}', 'departmentController@showDeparmentProfile');



// subject routes

Route::get('/teacher/subject/{subjectTeacher}', 'subjectController@getSubject');

Route::post('/subject/teacher/add', 'subjectController@addSubjectTeacher');

Route::get('/subject/teacher/{id}/remove', 'subjectController@removeSubjectTeacher');

// Comment routes

Route::post('/comment/add', 'commentController@addComment');

Route::get('teacher/subject/{subjectTeacher}', 'commentController@getComment');




// Admin route





Auth::routes();

Route::get('/home', 'HomeController@index');
