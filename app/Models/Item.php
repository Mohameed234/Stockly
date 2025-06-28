<?php

namespace App\Models;

use App\Traits\HasLogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasLogs;

    protected $fillable = [
        'type',
        'measurement',
        'amount',
        'qrcode',
        'in_date',
        'expire_date',
        'get_from',
        'get_to',
        'get_out_date',
        'amount_get_in',
        'warehouse_id'
    ];

    protected $casts = [
        'in_date' => 'date',
        'expire_date' => 'date',
        'get_out_date' => 'date',
        'amount' => 'decimal:2',
        'amount_get_in' => 'decimal:2'
    ];

    /**
     * Get the warehouse where this item is located.
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get the warehouses where this item can be stored.
     */
    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class)->withPivot('quantity');
    }
}
