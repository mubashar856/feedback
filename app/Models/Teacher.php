<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function department()
    {
    	return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function subjects()
    {
    	return $this->belongsToMany(Subject::class)->withPivot('id', 'semester_id');
    }

    public function subjectTeachers()
    {
        return $this->hasMany(SubjectTeacher::class);
    }
}
