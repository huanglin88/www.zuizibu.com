<?php

namespace App\Http\Controllers\Web;

use App\Article;
use App\ArticleCategory;
use App\Http\Controllers\Controller;
use App\Registration;
use App\School;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $data['articles_newest'] = Article::orderBy('created_at', 'DESC')->take(5)->get();
        $data['categories'] = ArticleCategory::take(3)->get();

        return view('web.index', $data);
    }
}
