<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 09/10/2017
 * Time: 16:51
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class QuizStudent extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'student_id', 'quiz_id', 'isSuccess'
    ];

    public function Student()
    {
        return $this->belongsTo('App\Student');
    }

    public function Quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
}