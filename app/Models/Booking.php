<?php

namespace App\Models;

use App\Observers\BookingObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_in_date',
        'check_out_date',
        'status',
        'total_price',
        'guests'
    ];

    protected $dates = [
        'check_in_date',
        'check_out_date',
    ];

    public static function boot()
    {
        parent::boot();
        self::observe(BookingObserver::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
