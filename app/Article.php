<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    const RECOMMEND_HOME_BROADCAST = 1;
    const RECOMMEND_HOME = 2;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\ArticleCategory', 'article_category_id');
    }
}
