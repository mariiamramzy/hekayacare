<?php

namespace App\Models\Concerns;

use App\Support\ActivityLogger;

trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        static::created(function ($model) {
            ActivityLogger::log('created', $model, [
                'after' => $model->attributesToArray(),
            ]);
        });

        static::updated(function ($model) {
            $changes = $model->getChanges();
            $before = [];
            foreach ($changes as $key => $value) {
                $before[$key] = $model->getOriginal($key);
            }

            ActivityLogger::log('updated', $model, [
                'before' => $before,
                'after' => $changes,
            ]);
        });

        static::deleted(function ($model) {
            ActivityLogger::log('deleted', $model, [
                'before' => $model->getOriginal(),
            ]);
        });
    }
}
