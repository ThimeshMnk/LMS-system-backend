<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lecture_id',
        'score',
        'total_questions'
    ];

    // The student who took the quiz
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // The lecture the quiz was for
    public function lecture(): BelongsTo
    {
        return $this->belongsTo(Lecture::class);
    }
}