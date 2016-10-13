<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Department;

use Illuminate\Http\Request;

use App\Http\Requests;

class teacherController extends Controller
{
    public function searchTeacher(Teacher $teacher, Request $request)
    {
    	$searchedName =  $request->teacher_name;
    	
        $teachers = Teacher::with('department')->where('teacher_name', 'like', '%'.$searchedName.'%')->orderBy('department_id')->get();

        return view('index', compact('teachers'));
        

    }

    public function addteacher(Teacher $teacher)
    {
    	$teacher->teacher_name = 'Aleem';
    	$teacher->teacher_email = 'aleem@check.com';
    	$teacher->department_id = '2';
    	$teacher->teacher_picture = 'pic1.jpg';
    	$teacher->teacher_information = 'This is test information for a teacher. And this can be change in future.';
    	$teacher->save();
    	return ('stored successfully');
    }

    public function getTeacher(Teacher $teacher, $id)
    {
    	$results = Teacher::where('id', $id)->first();
    	return view('profile', compact('results'));
    }

}
