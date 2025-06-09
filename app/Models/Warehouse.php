<?php

namespace App\Models;

use App\Traits\HasLogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Warehouse extends Model
{
    use HasLogs;

    protected $fillable = [
        'name',
        'location',
        'item_id'
    ];

    /**
     * Get the item in this warehouse.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
