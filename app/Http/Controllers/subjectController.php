<?php

namespace App\Http\Controllers;

use App\Models\Subject;

use App\Models\SubjectTeacher;

use App\Models\Teacher;

use Illuminate\Http\Request;

use App\Http\Requests;

class subjectController extends Controller
{


    public function getSubject(SubjectTeacher $subjectTeacher)
    {
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


    public function showSubjects()
    {
    	$subjects = Subject::all();
    	return view('admin.showSubjects', compact('subjects'));
    }

    public function showSubjectProfile($id)
    {	

    	$subject = Subject::find($id);

    	$subjectTeacher = SubjectTeacher::where('subject_id', $id)->get(['teacher_id'])->toArray();
    	
    	$teachers = Teacher::whereNotIn('id', $subjectTeacher)->get();

    	return view('admin.subjectProfile', compact('subject', 'teachers'));
    }

    public function addSubjectTeacher(Request $request)
    {
    	$this->validate($request, [
    		'subject_id' => 'required|integer|exists:subjects,id',
    		'teacher_id' => 'required|integer|exists:teachers,id'
    	]);

    	$subjectTeacher = new SubjectTeacher();

    	
        $subjectTeacher->teacher_id = $request->teacher_id;

        $subjectTeacher->subject_id = $request->subject_id;

        $subjectTeacher->save();

        return back();
    }

    public function removeSubjectTeacher($id)
    {
    	$subjectTeacher = SubjectTeacher::find($id);

    	$subjectTeacher->DELETE();

    	return back();
    }

}
