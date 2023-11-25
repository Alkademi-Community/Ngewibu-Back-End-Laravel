<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
