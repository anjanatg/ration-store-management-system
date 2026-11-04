<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    protected $table = 'stock';
    protected $fillable = [
        'product_id',
        'quantity',
        'transaction_type',
        'supplier_name',
        'notes',
        'transaction_date',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
            'transaction_date' => 'date',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
