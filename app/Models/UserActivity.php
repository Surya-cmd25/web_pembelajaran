<?php

namespace App\Models;

use Database\Factories\UserActivityFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'feature_key', 'completed_at'])]
class UserActivity extends Model
{
    /** @use HasFactory<UserActivityFactory> */
    use HasFactory;

    /**
     * The six learning activities tracked on the dashboard.
     *
     * @var list<string>
     */
    public const array FEATURES = ['materi', 'hafalan', 'galeri', 'quiz', 'soal', 'puzzle'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
        ];
    }

    /**
     * Mark a feature as completed for the given user.
     */
    public static function complete(int $userId, string $feature): void
    {
        static::query()->firstOrCreate(
            ['user_id' => $userId, 'feature_key' => $feature],
            ['completed_at' => now()],
        );
    }

    /**
     * Get the student who completed the activity.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
