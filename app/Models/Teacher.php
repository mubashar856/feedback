<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('teacher_name')
            ->saveSlugsTo('slug');
    }

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
