<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait UuidAsPrimary
{
    public function getKeyName()
    {
        return 'id';
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    protected static function bootUuidAsPrimary()
    {
        static::creating(function (Model $model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = static::generateUuid();
            }
        });
    }

    /**
     * @return string
     */
    public static function generateUuid(): string
    {
        return Uuid::uuid1()->toString();
    }
}
