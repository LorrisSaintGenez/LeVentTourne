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
    public $incrementing = false;

    use Uuids;

    protected $casts = [
        'answers' => 'array'
    ];

    protected $fillable = [
        'title', 'theme_id', 'question', 'good_answer', 'answers', 'point', 'picture', 'sound', 'video'
    ];

    public function articles()
    {
        return $this->hasMany('App\QuizStudent');
    }
}