<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategory extends Model
{
    use SoftDeletes;

    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
