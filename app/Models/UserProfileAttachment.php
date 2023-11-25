<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfileAttachment extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
