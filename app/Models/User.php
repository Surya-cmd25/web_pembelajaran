<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Determine whether the user is a teacher (admin).
     */
    public function isGuru(): bool
    {
        return $this->role === 'guru';
    }

    /**
     * Get the memorisation recordings submitted by the user.
     *
     * @return HasMany<Recording, $this>
     */
    public function recordings()
    {
        return $this->hasMany(Recording::class);
    }

    /**
     * Get the learning activities completed by the user.
     *
     * @return HasMany<UserActivity, $this>
     */
    public function activities()
    {
        return $this->hasMany(UserActivity::class);
    }

    /**
     * Get the reading records of the user.
     *
     * @return HasMany<MateriRead, $this>
     */
    public function materiReads()
    {
        return $this->hasMany(MateriRead::class);
    }

    /**
     * Determine whether the user has read the given material.
     */
    public function hasRead(Materi $materi): bool
    {
        return $this->materiReads()->where('materi_id', $materi->id)->exists();
    }

    /**
     * Get the quiz attempts made by the user.
     *
     * @return HasMany<QuizAttempt, $this>
     */
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    /**
     * Get the multiple-choice attempts made by the user.
     *
     * @return HasMany<McqAttempt, $this>
     */
    public function mcqAttempts()
    {
        return $this->hasMany(McqAttempt::class);
    }

    /**
     * Determine whether the given feature has been completed by the user.
     */
    public function hasCompleted(string $feature): bool
    {
        return $this->activities()->where('feature_key', $feature)->whereNotNull('completed_at')->exists();
    }
}
