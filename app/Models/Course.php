<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'code', 'instructor_id'];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class);
    }

    public function topics()
    {
        return $this->hasMany(ForumTopic::class);
    }

    public function materials()
    {
        return $this->hasMany(CourseMaterial::class);
    }
}
