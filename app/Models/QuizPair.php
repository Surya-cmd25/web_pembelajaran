<?php

namespace App\Models;

use Database\Factories\QuizPairFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['situation', 'correct_norm', 'explanation', 'is_active'])]
class QuizPair extends Model
{
    /** @use HasFactory<QuizPairFactory> */
    use HasFactory;

    /**
     * The four norm types a situation can be matched with.
     *
     * @var list<string>
     */
    public const array NORM_TYPES = ['agama', 'kesusilaan', 'kesopanan', 'hukum'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Scope the query to active pairs only.
     *
     * @param  Builder<self>  $query
     * @return Builder<self>
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
