<?php

namespace App\Models;

use Database\Factories\NormFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['slug', 'name', 'description', 'examples', 'sanctions', 'illustration_path', 'color', 'sort_order'])]
class Norm extends Model
{
    /** @use HasFactory<NormFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'examples' => 'array',
            'sanctions' => 'array',
            'sort_order' => 'integer',
        ];
    }
}
