<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QnaMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lecture_id',
        'message'
    ];

    // The user who sent the message
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // The lecture the message is on
    public function lecture(): BelongsTo
    {
        return $this->belongsTo(Lecture::class);
    }
}