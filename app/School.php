<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lorris
 * Date: 22/11/2017
 * Time: 15:43
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'address', 'zipcode', 'city', 'country', 'created_by_teacher_id'
    ];
}