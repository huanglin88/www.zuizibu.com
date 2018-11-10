<?php

namespace App\Http\Controllers\Api\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::with('category')->orderBy('created_at', 'DESC');

        if ($request->has('key') && !empty($request->key)) {
            $articles->where([
                ['title', 'like', '%' . $request->key . '%', 'or'],
                ['id', '=', $request->key, 'or']
            ]);
        }

        if (!empty($request->input('category_id'))) {
            $articles->where(['article_category_id' => $request->input('category_id')]);
        }

        return DataTables::of($articles)
            ->addColumn('actions', function ($article) {
                return '<a href="' . route('admin.article.edit', $article) . '" class="btn btn-xs btn-default" role="button" data-tab=\'' . json_encode(['name' => 'module_edit-article-' . $article->id, 'text' => '编辑资讯'], true) . '\'><i class="fa fa-edit"></i> 编辑</a> <button class="btn btn-xs btn-default J_delete" data-id="' . $article->id . '"><i class="fa fa-trash"></i> 删除</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function destroy($id)
    {
        Article::destroy($id);
    }
}
