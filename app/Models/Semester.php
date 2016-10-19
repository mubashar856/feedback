<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public function subjectTeachers(){
        return $this->hasMany(SubjectTeacher::class);
    }

}
