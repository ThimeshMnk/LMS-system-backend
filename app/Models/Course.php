<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        'enrollment_key',
    ];

    /**
     * Relationship: A course belongs to a Teacher (User).
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship: A course has many Lectures.
     */
    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class)->orderBy('id', 'asc');
    }

    /**
     * Accessor: Get the full URL for the course thumbnail.
     * This allows you to use $course->thumbnail_url in your Blade views.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }

        // Return a default placeholder if no image exists
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->title) . '&background=6366f1&color=fff&size=512';
    }
}