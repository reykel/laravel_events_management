<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transportation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'airport',
        'terminal',
        'airline',
        'flight_number',
        'station',
        'train_number',
        'other_location',
        'date',
        'hotel',
        'address',
        'transfer'
    ];

    public function executives(): HasMany
    {
        return $this->hasMany(Executive::class);
    }
}
