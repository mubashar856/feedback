<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('department_name')
            ->saveSlugsTo('slug');
    }
    public function teachers()
    {
    	return $this->hasMany(Teacher::class,'department_id', 'id');
    }
}
