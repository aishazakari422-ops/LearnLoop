<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
<<<<<<< HEAD
    protected $fillable = [
        'student_id',
        'lecturer_id',
        'material_title',
        'material_link',
        'note',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }
=======
    //
>>>>>>> origin/main
}
