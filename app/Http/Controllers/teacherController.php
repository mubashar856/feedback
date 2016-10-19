<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Teacher;

use App\Models\Department;

use App\Models\Subject;

use App\Models\SubjectTeacher;

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

    public function showEditTeacher($id)
    {
        $teacher = Teacher::find($id);

        return view('admin.editTeacher', compact('teacher'));
    }

    public function editTeacher(Request $request)
    {
        $this->validate($request,[
            'teacher_id' => 'required',
            'teacher_name' => 'required',
            'teacher_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'teacher_information' => 'required|min:10'
        ]);

        $teacher = Teacher::find($request->teacher_id);


        if ($request->teacher_email != $teacher->teacher_email) {
            $this->validate($request,[
                'teacher_email' => 'required|email|unique:teachers'
            ]);
        }


        $teacher->teacher_name = $request->teacher_name;
        $teacher->teacher_email = $request->teacher_email;
        $teacher->teacher_information = $request->teacher_information;

        if ($request->teacher_picture != '') {
            $teacher_picture_name = $teacher->teacher_picture;
            if(unlink(public_path('uploads/teacher/'.$teacher->teacher_picture))){
                $request->teacher_picture->move(public_path('uploads/teacher'), $teacher_picture_name);
            }
        }

        $teacher->UPDATE();

        return redirect('/admin/teachers');
    }

    public function removeTeacher($id)
    {      
        $teacher = Teacher::find($id);
        if (unlink(public_path('uploads/teacher/'.$teacher->teacher_picture))) {
            if ($teacher->DELETE()) {
                session()->flash('success', 'Teacher deleted successfully');
            }else{
                session()->flash('danger', 'Error occured while deleting teacher');
            }
        }

        return back();
    }


    public function showAddTeacher()
    {       
        $departments = Department::all();


        return view('admin.addTeacher', compact('departments'));
    }


    public function addTeacher(Request $request)
    {
        $this->validate($request,[
            'teacher_name' => 'required',
            'teacher_email' => 'required|email|unique:teachers',
            'department_id' => 'required|exists:departments,id',
            'teacher_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'teacher_information' => 'required|min:10'
        ]);


        $teacher_picture_new_name = $request->teacher_name.'-'.rand(100,999).'.'.$request->teacher_picture->getClientOriginalExtension();

        $request->teacher_picture->move(public_path('uploads/teacher'), $teacher_picture_new_name);


        $teacher = new Teacher();

        $teacher->teacher_name = $request->teacher_name;
        $teacher->teacher_email = $request->teacher_email;
        $teacher->department_id = $request->department_id;
        $teacher->teacher_picture = $teacher_picture_new_name;
        $teacher->teacher_information = $request->teacher_information;
        $teacher->save();

        $request->session()->flash('success', 'Teacher added successfully');

        return back();
    }


    public function showTeachers()
    {
        $teachers = Teacher::all();
        return view('admin.showTeachers', compact('teachers'));
    }

    public function showTeacherProfile($id)
    {
        $teacher = Teacher::find($id);

        $semesters = Semester::where('semester_status', '1')->get();

        $subjects = Subject::all();



        return view('admin.teacherProfile', compact('teacher', 'subjects', 'semesters'));
    }

}
