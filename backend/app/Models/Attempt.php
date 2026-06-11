<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attempt extends Model
{
    protected $fillable = ['topic_id', 'explanation', 'feedback'];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function score(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    public function gaps(): HasMany
    {
        return $this->hasMany(Gap::class);
    }
}
