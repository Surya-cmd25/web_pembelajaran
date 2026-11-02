<?php

namespace App\Models;

use Database\Factories\ConceptCardFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'front_text', 'back_text', 'icon', 'color', 'sort_order'])]
class ConceptCard extends Model
{
    /** @use HasFactory<ConceptCardFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    /**
     * Get the recordings submitted for this concept card.
     *
     * @return HasMany<Recording, $this>
     */
    public function recordings(): HasMany
    {
        return $this->hasMany(Recording::class);
    }
}
