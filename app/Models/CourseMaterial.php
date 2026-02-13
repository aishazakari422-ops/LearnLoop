<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMaterial extends Model
{
    protected $fillable = ['course_id', 'title', 'type', 'content'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function completedByStudents()
    {
        return $this->belongsToMany(User::class, 'course_material_user');
    }
}
