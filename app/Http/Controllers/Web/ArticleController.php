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
        }

        if (!empty($request->input('key'))) {
            $articleQuery->where('title', 'like', '%' . $request->key . '%');
        }


        $data['articles'] = $articleQuery->paginate(2);
        $data['categories'] = ArticleCategory::all();

        //热点资讯
        $data['WIDGETS']['hottest'] = Article::orderBy('views', 'DESC')->take(10)->get();

        //就业指南
        $data['article_guide'] = Article::select('slug', 'title')
            ->orderBy('created_at', 'desc')
            ->where('article_category_id', 1)
            ->take(10)
            ->get();

        //认证考试
        $data['article_exam'] = Article::select('slug', 'title')
            ->orderBy('created_at', 'desc')
            ->where('article_category_id', 1)
            ->take(10)
            ->get();

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

        $data['WIDGETS']['hottest'] = Article::orderBy('views', 'DESC')->take(10)->get();
        $data['WIDGETS']['related'] = Article::inRandomOrder()->take(4)->get();

        return view('web.article.show', $data);
    }
}
