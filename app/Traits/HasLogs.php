<?php

namespace App\Traits;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

trait HasLogs
{
    /**
     * Boot the trait.
     */
    protected static function bootHasLogs()
    {
        static::created(function ($model) {
            $model->logActivity('create');
        });

        static::updated(function ($model) {
            $model->logActivity('update');
        });

        static::deleted(function ($model) {
            $model->logActivity('delete');
        });
    }

    /**
     * Log the activity.
     */
    public function logActivity($action)
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model_type' => get_class($this),
            'model_id' => $this->id,
            'old_values' => $action === 'update' ? $this->getOriginal() : null,
            'new_values' => $action === 'delete' ? null : $this->toArray(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'description' => $this->getLogDescription($action)
        ]);
    }

    /**
     * Get the description for the log.
     */
    protected function getLogDescription($action): string
    {
        $modelName = class_basename($this);

        return match($action) {
            'create' => "New {$modelName} created",
            'update' => "{$modelName} updated",
            'delete' => "{$modelName} deleted",
            default => "{$modelName} {$action} action performed"
        };
    }

    /**
     * Get all logs for this model.
     */
    public function logs()
    {
        return $this->morphMany(Log::class, 'model');
    }
}
