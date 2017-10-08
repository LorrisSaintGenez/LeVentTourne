<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 08/10/2017
 * Time: 15:41
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title', 'question', 'answer_1', 'answer_2', 'answer_3', 'answer_4', 'solution', 'point', 'picture', 'sound', 'video'
    ];
}