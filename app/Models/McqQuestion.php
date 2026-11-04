<?php

namespace App\Models;

use Database\Factories\McqQuestionFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['question', 'difficulty', 'options', 'correct_index', 'explanation', 'sort_order', 'is_active'])]
class McqQuestion extends Model
{
    /** @use HasFactory<McqQuestionFactory> */
    use HasFactory;

    /**
     * Difficulty level used when a question is created without one.
     */
    public const string DEFAULT_DIFFICULTY = 'sedang';

    /**
     * Available difficulty levels mapped to the label shown to teachers and students.
     *
     * @var array<string, string>
     */
    public const array DIFFICULTIES = [
        'mudah' => 'Mudah',
        'sedang' => 'Sedang',
        'sulit' => 'Sulit',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'options' => 'array',
            'correct_index' => 'integer',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Scope the query to active questions only.
     *
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope the query to a single difficulty level.
     *
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeDifficulty(Builder $query, string $level): Builder
    {
        return $query->where('difficulty', $level);
    }
}
