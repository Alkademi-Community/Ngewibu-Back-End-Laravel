<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    /**
     * Get the cities for the province.
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
