<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningMaterial extends Model
{
    protected $fillable = [
        'learning_goal_id',
        'title',
        'type',
        'content_url',
    ];

    public function learningGoal()
    {
        return $this->belongsTo(LearningGoal::class);
    }
}
