<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperOrder
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'burger_id', 'quantity', 'status', 'facture'
    ];

    /**
     * Relationship for a customer.
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relationship for a burger.
     *
     * @return BelongsTo
     */
    public function burger() : BelongsTo
    {
        return $this->belongsTo(Burger::class);
    }
}
