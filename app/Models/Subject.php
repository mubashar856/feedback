<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function teachers()
    {
    	return $this->belongsToMany(Teacher::class)->withPivot('id', 'semester_id');
    }

    public function subjectTeachers()
    {
        return $this->hasMany(SubjectTeacher::class);
    }


}
