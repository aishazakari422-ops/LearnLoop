<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningGoal extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_date',
        'target_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'target_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function materials()
    {
        return $this->hasMany(LearningMaterial::class);
    }

    public function progress()
    {
        return $this->hasOne(Progress::class);
    }
<<<<<<< HEAD

    /**
     * Refresh the goal progress based on material completion.
     */
    public function refreshProgress()
    {
        $total = $this->materials()->count();
        if ($total === 0) {
            $percentage = 0;
        } else {
            $completed = $this->materials()->where('is_completed', true)->count();
            $percentage = round(($completed / $total) * 100);
        }

        $this->progress()->updateOrCreate(
            ['learning_goal_id' => $this->id],
            ['percentage' => $percentage]
        );

        return $percentage;
    }
=======
>>>>>>> origin/main
}
