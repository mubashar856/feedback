<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Subject;

use App\Models\SubjectTeacher;

use App\Models\Teacher;

use Illuminate\Http\Request;

use App\Http\Requests;

class subjectController extends Controller
{


    public function getSubject($teacher, $semester, $subject)
    {
        $teacherId = Teacher::where('slug', $teacher)->first()->id;
        $semesterId = Semester::where('slug', $semester)->first()->id;
        $subjectId = Subject::where('slug', $subject)->first()->id;

        $subjectTeacher = SubjectTeacher::where('teacher_id', $teacherId)->where('subject_id', $subjectId)->where('semester_id', $semesterId)->first();

        return view('subject', compact('subjectTeacher'));
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

    public function showAddSubject()
    {
        return view('admin.addSubject');
    }

    public function addSubject(Request $request)
    {
        $this->validate($request, [
            'subject_name' => 'required',
            'subject_logo' => 'max:2048|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $subject = new Subject();

        if($request->subject_logo != ''){
            $subject_logo_name = $request->subject_name.'-'.rand(100, 999).'.'.$request->subject_logo->getClientOriginalExtension();
            $request->subject_logo->move(public_path('uploads/subject'), $subject_logo_name);
        }else{
            $subject_logo_name = 'default.png';
        }

        $subject->subject_name = $request->subject_name;

        $subject->subject_logo = $subject_logo_name;

        $subject->save();

        $request->session()->flash('success', 'Subject added successfully');

        return back();
    }


    public function showSubjects()
    {
    	$subjects = Subject::all();
    	return view('admin.showSubjects', compact('subjects'));
    }

    public function showSubjectProfile($id)
    {	

    	$subject = Subject::find($id);

    	$semesters = Semester::where('semester_status', '1')->get();
    	
    	$teachers = Teacher::all();

    	return view('admin.subjectProfile', compact('subject', 'teachers', 'semesters'));
    }

    public function addSubjectTeacher(Request $request)
    {
    	$this->validate($request, [
            'semester_id' => 'required|integer|exists:semesters,id',
            'subject_id' => 'required|integer|exists:subjects,id',
    		'teacher_id' => 'required|integer|exists:teachers,id'
    	]);

        $check = SubjectTeacher::where('subject_id', $request->subject_id)->where('semester_id', $request->semester_id)->where('teacher_id', $request->teacher_id)->get();

        if(count($check)){
           session()->flash('danger', 'record already exists');
        }else{
            $subjectTeacher = new SubjectTeacher();

            $subjectTeacher->teacher_id = $request->teacher_id;

            $subjectTeacher->subject_id = $request->subject_id;

            $subjectTeacher->semester_id = $request->semester_id;

            $subjectTeacher->save();
        }

        return back();
    }

    public function removeSubjectTeacher($id)
    {
    	$subjectTeacher = SubjectTeacher::find($id);

    	$subjectTeacher->DELETE();

    	return back();
    }

}
