<?php

namespace App\Models;

use Database\Factories\RecordingFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'concept_card_id', 'audio_path', 'duration', 'status', 'feedback', 'reviewed_at'])]
class Recording extends Model
{
    /** @use HasFactory<RecordingFactory> */
    use HasFactory;

    public const string STATUS_MENUNGGU = 'menunggu';

    public const string STATUS_DITERIMA = 'diterima';

    public const string STATUS_PERLU_PERCOBAAN = 'perlu_percobaan';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'duration' => 'integer',
            'reviewed_at' => 'datetime',
        ];
    }

    /**
     * Get the student who submitted the recording.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the concept card this recording was submitted for.
     *
     * @return BelongsTo<ConceptCard, $this>
     */
    public function conceptCard(): BelongsTo
    {
        return $this->belongsTo(ConceptCard::class);
    }

    /**
     * Get the human readable status label.
     */
    public function statusLabel(): string
    {
        return match ($this->status) {
            self::STATUS_DITERIMA => 'Diterima',
            self::STATUS_PERLU_PERCOBAAN => 'Perlu Percobaan',
            default => 'Menunggu Review',
        };
    }
}
