<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */


     public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'enrollment_key_required' => !empty($this->enrollment_key),
        'thumbnail' => $this->image ? asset('storage/' . $this->image) : 'https://placehold.co/600x400?text=Course',
        'teacher_name' => $this->teacher->name,
        'lectures' => LectureResource::collection($this->whenLoaded('lectures')),
        'lectures_count' => $this->lectures_count ?? $this->lectures->count(),
    ];
}
}
