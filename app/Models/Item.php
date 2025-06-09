<?php

namespace App\Models;

use App\Traits\HasLogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'amount_get_in'
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
    public function warehouse(): HasOne
    {
        return $this->hasOne(Warehouse::class);
    }
}
