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



// department routes




// subject routes

Route::get('/teacher/subject/{subjectTeacher}', 'subjectController@getSubject');






// Comment routes

Route::post('/comment/add', 'commentController@addComment');

Route::get('teacher/subject/{subjectTeacher}', 'commentController@getComment');




// Admin route

Route::get('/admin/teachers', 'adminController@showTeachers');

Route::get('/admin/departments', 'adminController@showDepartments');

Route::get('/admin/subjects', 'adminController@showSubjects');

Route::get('/admin/teacher/add', 'adminController@showAddTeacher');

Route::post('/admin/teacher/add', 'adminController@addTeacher');

Route::get('/admin/department/add', 'adminController@showAddDepartment');

Route::post('/admin/department/add', 'adminController@addDepartment');

Route::get('/admin/subject/add', 'adminController@showAddSubject');

Route::post('/admin/subject/add', 'adminController@addSubject');

Route::get('/admin/department/{id}/remove', 'adminController@removeDepartment');

Route::get('/admin/department/{id}/edit', 'adminController@showEditDepartment');

Route::post('/admin/department/edit', 'adminController@editDepartment');

Route::get('/admin/teacher/{id}/remove', 'adminController@removeTeacher');

Route::get('/admin/teacher/{id}/edit', 'adminController@showEditTeacher');

Route::post('/admin/teacher/edit', 'adminController@editTeacher');

Route::get('/admin/subject/{id}/remove', 'adminController@removeSubject');

Route::get('/admin/subject/{id}/edit', 'adminController@showEditSubject');

Route::post('/admin/subject/edit', 'adminController@editSubject');




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