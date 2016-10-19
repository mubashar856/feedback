<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    protected $table = 'subject_teacher';


    public function subject()
    {
    	return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
    	return $this->belongsTo(Teacher::class);
    }

    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }

}
