<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['level', 'title', 'description', 'image_path', 'rows', 'cols', 'time_limit', 'is_active'])]
class PuzzleLevel extends Model
{
    /**
     * The maximum number of levels the teacher may configure.
     */
    public const int MAX_LEVELS = 5;

    /**
     * Image used when a level has no uploaded picture.
     */
    public const string DEFAULT_IMAGE = 'images/durkheim.svg';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'level' => 'integer',
            'rows' => 'integer',
            'cols' => 'integer',
            'time_limit' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Scope the query to active levels ordered by level number.
     *
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('level');
    }

    /**
     * Total number of pieces on the board.
     */
    public function pieceCount(): int
    {
        return $this->rows * $this->cols;
    }

    /**
     * Public URL of the level picture.
     */
    public function imageUrl(): string
    {
        return $this->image_path
            ? asset('storage/'.$this->image_path)
            : asset(self::DEFAULT_IMAGE);
    }
}
