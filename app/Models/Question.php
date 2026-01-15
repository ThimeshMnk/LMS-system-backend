<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecture_id',
        'question_text'
    ];

    // Get the lecture this question belongs to
    public function lecture(): BelongsTo
    {
        return $this->belongsTo(Lecture::class);
    }

    // Get the options for this question
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }
}