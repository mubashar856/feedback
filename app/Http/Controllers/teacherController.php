<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Teacher;
use App\Utils\Util;
use App\Models\Department;

use App\Models\Subject;

use App\Models\SubjectTeacher;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class teacherController extends Controller
{
    public function searchTeacher(Request $request)
    {
    	$searchedName =  $request->teacher_name;
    	
        $teachers = Teacher::with('department')->where('teacher_name', 'like', '%'.$searchedName.'%')->orderBy('department_id')->get();

        return view('index', compact('teachers'));
        

    }


    public function getTeacher($slug)
    {
    	$teacher = Teacher::where('slug', $slug)->first();
    	return view('profile', compact('teacher'));
    }

    public function showEditTeacher($id)
    {
        $teacher = Teacher::find($id);
        $departments = Department::all();

        return view('admin.editTeacher', compact('teacher', 'departments'));
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
            if(Util::deleteImage('teacher', $teacher->teacher_picture)){
                $request->teacher_picture->move(public_path('uploads/teacher'), $teacher_picture_name);
            }
        }

        $teacher->UPDATE();

        return redirect('/admin/teachers');
    }

    public function removeTeacher($id)
    {      
        $teacher = Teacher::find($id);
        if (Util::deleteImage('teacher', $teacher->teacher_picture)) {
            User::where('id', $teacher->user_id)->delete();
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

        $user = new User();

        $user->name = $request->teacher_name;
        $user->email = $request->teacher_email;
        $user->password = bcrypt('teacher');
        $user->check_password = 0;
        $user->role = 'teacher';
        if($user->save()){

            $teacher_picture_new_name = $request->teacher_name.'-'.rand(100,999).'.'.$request->teacher_picture->getClientOriginalExtension();
            $request->teacher_picture->move(public_path('uploads/teacher'), $teacher_picture_new_name);

            $teacher = new Teacher();
            $teacher->user_id = $user->id;
            $teacher->teacher_name = $request->teacher_name;
            $teacher->teacher_email = $request->teacher_email;
            $teacher->department_id = $request->department_id;
            $teacher->teacher_picture = $teacher_picture_new_name;
            $teacher->teacher_information = $request->teacher_information;
            $teacher->save();
        }else{
            return 'failed to add user';
        }

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

    public function getRecommendedResults(Request $request){
        $teachers = Teacher::where('teacher_name', 'LIKE', '%'.$request->search.'%')->get(['teacher_name', 'slug'])->toJson();

        return $teachers;
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
    public function checkPassword(){
        if (Auth::user()->check_password == 0){
            return false;
        }
        return true;
    }
    public function showDashboard(){
        if(!$this->checkPassword()){
            return redirect('/teacher/changePassword');
        }
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        $subjectTeachers = SubjectTeacher::where('teacher_id', $teacher->id)->get();

        return view('teacher.index', compact('teacher', 'subjectTeachers'));
    }

    public function showChangePassword(){
        return view('teacher.changePassword');
    }

    public function changePassword(Request $request){
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
        if (!Hash::check($request->old_password, Auth::user()->password))
        {
            $request->session()->flash('error', 'The old password you entered didn\'t match.');
            return back();
        }
        $user = User::where('id', Auth::user()->id);
        $user->update(['password' => Hash::make($request->password), 'check_password' => '1']);
        $request->session()->flash('success', 'Password changed successfully');
        return back();
    }

    public function showSubjectProfile($subjectTeacher){
        if(!$this->checkPassword()){
            return redirect('/teacher/changePassword');
        }
        $subjectTeacher = SubjectTeacher::where('id', $subjectTeacher)->first();
        return view('teacher.subject', compact('subjectTeacher'));
    }

}
