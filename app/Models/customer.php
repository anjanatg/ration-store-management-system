<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    protected $fillable = [
        'card_category_id',
        'name',
        'address',
        'phone',
        'ration_card_number',
    ];

    public function cardCategory(): BelongsTo
    {
        return $this->belongsTo(card_categories::class);
    }
}
