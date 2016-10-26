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



//admin group
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function ()
{
//    teacher routes
    Route::get('teachers', 'teacherController@showTeachers');
    Route::get('teacher/add', 'teacherController@showAddTeacher');
    Route::post('teacher/add', 'teacherController@addTeacher');
    Route::get('teacher/{id}/remove', 'teacherController@removeTeacher');
    Route::get('teacher/{id}/edit', 'teacherController@showEditTeacher');
    Route::post('teacher/edit', 'teacherController@editTeacher');
    Route::get('teacher/{id}', 'teacherController@showTeacherProfile');


//    department routes
    Route::get('departments', 'departmentController@showDepartments');
    Route::get('department/add', 'departmentController@showAddDepartment');
    Route::post('department/add', 'departmentController@addDepartment');
    Route::get('department/{id}/remove', 'departmentController@removeDepartment');
    Route::get('department/{id}/edit', 'departmentController@showEditDepartment');
    Route::post('department/edit', 'departmentController@editDepartment');
    Route::get('profile/department/{id}', 'departmentController@showDepartmentProfile');

//    subject routes
    Route::get('subjects', 'subjectController@showSubjects');
    Route::get('subject/add', 'subjectController@showAddSubject');
    Route::post('subject/add', 'subjectController@addSubject');
    Route::get('subject/{id}/remove', 'subjectController@removeSubject');
    Route::get('subject/{id}/edit', 'subjectController@showEditSubject');
    Route::post('subject/edit', 'subjectController@editSubject');
    Route::get('subject/{id}', 'subjectController@showSubjectProfile');

//    semester routes
    Route::get('semester/add', 'semesterController@showAddSemester');
    Route::post('semester/add', 'semesterController@addSemester');
    Route::get('semesters', 'semesterController@showSemesters');
    Route::get('semester/{semester}/new-status/{status}', 'semesterController@changeStatus');

//    admin routes
    Route::get('logout', 'adminController@logout');
    Route::get('/', function (){
        return view('admin.index');
    });

//    subject teacher routes
    Route::post('teacher/subject/add', 'teacherController@addTeacherSubject');
    Route::get('teacher/subject/{id}/remove', 'teacherController@removeTeacherSubject');
    Route::post('subject/teacher/add', 'subjectController@addSubjectTeacher');
    Route::get('subject/teacher/{id}/remove', 'subjectController@removeSubjectTeacher');


});

Route::group(['prefix' => 'teacher', 'middleware' => 'teacher'], function (){

//    Teacher Routes

    Route::get('/', 'teacherController@showDashboard');
    Route::get('changePassword', 'teacherController@showChangePassword');
    Route::get('logout', 'teacherController@logout');
    Route::get('subject/{subjectTeacher}', 'teacherController@showSubjectProfile');
    Route::post('profile/update/password/', 'teacherController@changePassword');



});











//general routes

Route::get('/exchange', 'loginController@checkRole');

// teacher routes
Route::post('/', 'teacherController@searchTeacher');
Route::get('/teacher/{slug}', 'teacherController@getTeacher');

Route::post('/teacher/search/recommended', 'teacherController@getRecommendedResults');

// subject routes
Route::get('{teacher}/{semester}/{subject}', 'subjectController@getSubject');

// Comment routes
Route::post('/comment/add', 'commentController@addComment');

//auth predefined routes
Auth::routes();
Route::get('/home', 'HomeController@index');
