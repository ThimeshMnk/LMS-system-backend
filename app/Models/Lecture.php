<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id', 
        'title',
        'image',     
        'description',
        'gdrive_id',
        'duration'   
    ];

    // Get the teacher who owns this lecture
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Get the questions for this lecture
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    // Get the QnA messages for this lecture
    public function qnaMessages(): HasMany
    {
        return $this->hasMany(QnaMessage::class);
    }

    public function course() {
    return $this->belongsTo(Course::class);
}
}