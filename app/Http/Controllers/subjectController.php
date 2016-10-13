<?php

namespace App\Http\Controllers;

use App\Models\Subject;

use App\Models\SubjectTeacher;

use Illuminate\Http\Request;

use App\Http\Requests;

class subjectController extends Controller
{
    public function addSubject(Subject $subject)
    {
    	$subject->subject_name = 'Web Engineering';
    	$subject->subject_logo = 'web.jpg';
    	$subject->save();
    	return 'subject added successfully';
    }

    public function getSubject(SubjectTeacher $subjectTeacher)
    {
        return $subjectTeacher->teacher_id;
    }

}
