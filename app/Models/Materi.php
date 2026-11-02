<?php

namespace App\Models;

use Database\Factories\MateriFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['slug', 'title', 'summary', 'body', 'quote', 'audio_path', 'audio_duration', 'sort_order', 'is_published'])]
class Materi extends Model
{
    /** @use HasFactory<MateriFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'audio_duration' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Scope the query to published materi only.
     *
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Get the students who have read this material.
     *
     * @return HasMany<MateriRead, $this>
     */
    public function reads()
    {
        return $this->hasMany(MateriRead::class);
    }

    /**
     * Get the formatted audio duration (mm:ss).
     */
    public function formattedDuration(): string
    {
        $minutes = intdiv($this->audio_duration, 60);
        $seconds = $this->audio_duration % 60;

        return sprintf('%d:%02d', $minutes, $seconds);
    }
}
