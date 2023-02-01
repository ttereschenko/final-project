<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
