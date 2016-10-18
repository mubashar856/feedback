<?php

namespace App\Http\Controllers;

use App\Models\Subject;

use App\Models\SubjectTeacher;

use Illuminate\Http\Request;

use App\Http\Requests;

class subjectController extends Controller
{


    public function getSubject(SubjectTeacher $subjectTeacher)
    {
        return view('subject', compact('subjectTeacher'));
    }

}
