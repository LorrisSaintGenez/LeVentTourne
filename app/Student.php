<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 09/10/2017
 * Time: 16:41
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'teacher_id'
    ];

    public function articles()
    {
        return $this->hasMany('App\QuizStudent');
    }
}