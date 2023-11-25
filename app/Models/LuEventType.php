<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LuEventType extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
