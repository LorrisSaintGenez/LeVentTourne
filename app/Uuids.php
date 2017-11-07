<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 07/11/2017
 * Time: 17:22
 */

namespace App;

use Webpatser\Uuid\Uuid;

trait Uuids
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}