<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use App\Models\SubjectTeacher;

use Illuminate\Http\Request;

use App\Http\Requests;

class commentController extends Controller
{
    public function addComment(Comment $comment, Request $request)
    {
    	$user_name = $request->user_name;
    	if ($user_name == '') {
    		$user_name = 'Anonymous';
    	}

    	$this->validate($request, [
    		'comment' => 'required|min:10',
    		'subject_teacher_id' => 'required'
    	]);

    	$comment->user_name = $user_name;
    	$comment->comment = $request->comment;
    	$comment->subject_teacher_id = $request->subject_teacher_id;

    	$comment->save();

    	return back();
    }

    public function getComment(SubjectTeacher $subjectTeacher)
    {
    	return view('subject', compact('subjectTeacher'));
    }

}
