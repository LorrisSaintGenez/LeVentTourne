<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 22/11/2017
 * Time: 15:48
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'school_id'
    ];
}