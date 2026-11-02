<?php

namespace App\Models;

use Database\Factories\PuzzleProgressFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'level', 'placed', 'is_completed'])]
class PuzzleProgress extends Model
{
    /** @use HasFactory<PuzzleProgressFactory> */
    use HasFactory;

    /**
     * Number of puzzle pieces on the board.
     */
    public const int PIECE_COUNT = 10;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'level' => 'integer',
            'placed' => 'array',
            'is_completed' => 'boolean',
        ];
    }

    /**
     * Get the student who owns this progress.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
