<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'address',
        'lat',
        'lng',
        'city_id',
    ];

    /**
     * Get the city that owns the stock.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
