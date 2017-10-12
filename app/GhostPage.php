<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GhostPage extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'title', 'description'
    ];
}
