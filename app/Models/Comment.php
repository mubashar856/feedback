<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function subjectTeacher()
    {
    	return $this->belongsTo(SubjectTeacher::class); 
    }
}
