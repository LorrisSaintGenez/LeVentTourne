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
    public $timestamps = false;

    protected $fillable = [
        'student_id', 'classroom_id'
    ];

    public function Student()
    {
        return $this->belongsTo('App\Users');
    }

    public function Classroom()
    {
        return $this->belongsTo('App\Classroom');
    }
}