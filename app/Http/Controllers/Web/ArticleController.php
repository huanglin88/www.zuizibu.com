<?php

namespace App\Http\Controllers\Web;

use App\Article;
use App\ArticleCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        $data = [];

        $articleQuery = Article::orderBy('created_at', 'DESC');
        if ($slug) {
            $articleQuery->whereHas('category', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });
            $data['category'] = ArticleCategory::where('slug',$slug)->first();
        }
        $data['articles'] = $articleQuery->paginate(2);


        return view('web.article.index', $data);
    }

    public function show($slug)
    {
        $data = [];

        if (!$article = Article::with(['user', 'category'])->where('slug', $slug)->first()) {
            abort(404);
        }

        $article->increment('views');

        $data['article'] = $article;
        $data['category'] = ArticleCategory::where('id',$article->article_category_id)->first();

        return view('web.article.show', $data);
    }
}
