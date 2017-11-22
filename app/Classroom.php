<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 22/11/2017
 * Time: 16:14
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'teacher_id', 'school_id', 'name'
    ];

    public function ClassStudent()
    {
        return $this->hasMany('App\ClassStudent');
    }
}