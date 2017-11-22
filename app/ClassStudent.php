<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 22/11/2017
 * Time: 16:17
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'student_id', 'class_id'
    ];

    public function Student()
    {
        return $this->belongsTo('App\Student');
    }

    public function Classroom()
    {
        return $this->belongsTo('App\Classroom');
    }
}