<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait HasUuid
{
    public static function bootHasUuid(): void 
    {
        static::creating(function(Model $model) {
            // dd($model, Uuid::uuid4()->toString());
            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
