<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 04/11/2017
 * Time: 14:13
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title', 'max_point', 'picture'
    ];
}