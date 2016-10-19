<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

use App\Http\Requests;

class semesterController extends Controller
{
    public function showAddSemester()
    {
        return view('admin.addSemester');
    }

    public function addSemester(Request $request)
    {
        $this->validate($request, [
           'semester_name' => 'required|unique:semesters,semester_name|min:4'
        ]);

        $semester = new Semester();

        $semester->semester_name = $request->semester_name;

        $semester->semester_status = '1';

        $semester->save();

        $request->session()->flash('success', 'Semester added successfully');

        return back();
    }

    public function showSemesters(){

        $semesters = Semester::all();

        return view('admin.showSemesters', compact('semesters'));
    }

    public function changeStatus($semester, $status){

        $semester = Semester::find($semester);

        $semester->semester_status = $status;

        $semester->update();

        return back();
    }


}
