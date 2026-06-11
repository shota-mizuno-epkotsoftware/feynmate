<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gap extends Model
{
    protected $fillable = ['attempt_id', 'body'];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(Attempt::class);
    }
}
