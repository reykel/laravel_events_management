<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Executive extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'mobile',
        'passport',
        'nationality',
        'arrive_id',
        'task_id',
        'departure_id',
        'allergies',
        'special_needs',
        'phone_code',
        'mobile_code',
        'company',
        'assist'
    ];

    public function arrive(): BelongsTo
    {
        return $this->belongsTo(Transportation::class);
    }

    public function departure(): BelongsTo
    {
        return $this->belongsTo(Transportation::class);
    }

    public function tasks(): BelongsTo
    {
        return $this->BelongsTo(TaskExecutive::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(ExecutiveActivity::class);
    }
}
