<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Todo extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'todos';

    protected $fillable = ['title', 'description'];
}
