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


    public function getTeacher(Teacher $teacher, $id)
    {
    	$results = Teacher::where('id', $id)->first();
    	return view('profile', compact('results'));
    }

}
