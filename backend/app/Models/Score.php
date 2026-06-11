<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Score extends Model
{
    protected $fillable = ['attempt_id', 'criterion', 'score'];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(Attempt::class);
    }
}
