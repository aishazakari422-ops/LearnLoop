<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $fillable = [
        'learning_goal_id',
        'percentage',
    ];

    public function learningGoal()
    {
        return $this->belongsTo(LearningGoal::class);
    }
}
