<?php

namespace App\Http\Controllers;

use App\Models\Teacher;

use App\Models\Department;

use App\Models\Subject;

use Illuminate\Http\Request;

use App\Http\Requests;



class adminController extends Controller
{


    public function showTeachers()
    {
    	$teachers = Teacher::all();
    	return view('admin.showTeachers', compact('teachers'));
    }

    public function showDepartments()
    {
    	$departments = Department::all();
    	return view('admin.showDepartments', compact('departments'));
    }

    public function showSubjects()
    {
    	$subjects = Subject::all();
    	return view('admin.showSubjects', compact('subjects'));
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

    public function showAddDepartment()
    {
        return view('admin.addDepartment');
    }

    public function addDepartment(Request $request)
    {
        $this->validate($request, [
            'department_name' => 'required',
            'department_logo' => 'required|max:2048|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $department = new Department();

        $department_logo_name = $request->department_name.'-'.rand(100, 999).'.'.$request->department_logo->getClientOriginalExtension();

        $request->department_logo->move(public_path('uploads/department'), $department_logo_name);

        $department->department_name = $request->department_name;

        $department->department_logo = $department_logo_name;

        $department->save();

        $request->session()->flash('success', 'Department added successfully');

        return back();
    }

    public function showAddSubject()
    {
        return view('admin.addSubject');
    }

    public function addSubject(Request $request)
    {
        $this->validate($request, [
            'subject_name' => 'required',
            'subject_logo' => 'required|max:2048|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $subject = new Subject();

        $subject_logo_name = $request->subject_name.'-'.rand(100, 999).'.'.$request->subject_logo->getClientOriginalExtension();

        $request->subject_logo->move(public_path('uploads/subject'), $subject_logo_name);

        $subject->subject_name = $request->subject_name;

        $subject->subject_logo = $subject_logo_name;

        $subject->save();

        $request->session()->flash('success', 'Subject added successfully');

        return back();
    }


    public function removeDepartment($id)
    {      
        $department = Department::find($id);
        if (unlink(public_path('uploads/department/'.$department->department_logo))) {
            if ($department->DELETE()) {
                session()->flash('success', 'Department deleted successfully');
            }else{
                session()->flash('danger', 'Error occured while deleting department');
            }
        }

        return back();
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


    public function removeSubject($id)
    {      
        $subject = Subject::find($id);
        if (unlink(public_path('uploads/subject/'.$subject->subject_logo))) {
            if ($subject->DELETE()) {
                session()->flash('success', 'Subject deleted successfully');
            }else{
                session()->flash('danger', 'Error occured while deleting subject');
            }
        }

        return back();
    }

    public function showEditDepartment($id)
    {
        $department = Department::find($id);

        return view('admin.editDepartment', compact('department'));

    }

    public function editDepartment(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required| exists:departments,id',
            'department_name' => 'required',
            'department_logo' => 'max:2048|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $department = Department::find($request->department_id);

        $department->department_name = $request->department_name;

        if ($request->department_logo != '') {
            $department_logo_name = $department->department_logo;
            if(unlink(public_path('uploads/department/'.$department->department_logo))){
                $request->department_logo->move(public_path('uploads/department'), $department_logo_name);
            }
        }
        $department->UPDATE();
        return redirect('/admin/departments');
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

    public function showEditSubject($id)
    {
        $subject = Subject::find($id);

        return view('admin.editSubject', compact('subject'));

    }

    public function editSubject(Request $request)
    {
        $this->validate($request, [
            'subject_id' => 'required| exists:subjects,id',
            'subject_name' => 'required',
            'subject_logo' => 'max:2048|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $subject = Subject::find($request->subject_id);

        $subject->subject_name = $request->subject_name;

        if ($request->subject_logo != '') {
            $subject_logo_name = $subject->subject_logo;
            if(unlink(public_path('uploads/subject/'.$subject->subject_logo))){
                $request->subject_logo->move(public_path('uploads/subject'), $subject_logo_name);
            }
        }
        $subject->UPDATE();
        return redirect('/admin/subjects');
    }


}
