<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get the event that the comment belongs to.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
