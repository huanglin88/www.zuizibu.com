<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Krucas\Notification\Facades\Notification;

class ArticleController extends Controller
{
    /**
     * @action index
     * @actionName 资讯列表
     */
    public function index()
    {
        return view('admin.article.index');
    }

    /**
     * @action create
     * @actionName 创建资讯
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * @action store
     * @actionName 添加资讯
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'article_category_id' => ['required', 'exists:article_categories,id'],
            'title' => ['required'],
            'abstract' => ['required'],
            'slug' => ['required', 'unique:articles'],
            'content' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            $article = new Article;
            $fields = ['article_category_id', 'title', 'slug', 'cover', 'content', 'sort','abstract'];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    $article->$field = $request->input($field);
                }
            }
            $article->user_id = auth()->id();
            $article->save();

            DB::commit();
            Notification::success('资讯创建成功');

            return redirect()->route('admin.article.edit', $article);
        } catch (\Exception $e) {
            DB::rollBack();
            Notification::error("资讯创建失败[{$e->getMessage()}]");
            return redirect()->route('admin.article.create');
        }
    }

    /**
     * @action edit
     * @actionName 编辑资讯
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('admin.article.edit', compact('article'));
    }

    /**
     * @action update
     * @actionName 修改资讯
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $this->validate($request, [
            'article_category_id' => ['required', 'exists:article_categories,id'],
            'title' => ['required'],
            'abstract' => ['required'],
            'slug' => ['required', Rule::unique('articles')->ignore($article->id)],
            'content' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            $fields = ['article_category_id', 'title', 'slug', 'cover', 'content', 'sort','abstract'];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    $article->$field = $request->input($field);
                }
            }
            $article->user_id = auth()->id();
            $article->save();

            DB::commit();
            Notification::success('资讯编辑成功');

        } catch (\Exception $e) {
            DB::rollBack();
            Notification::error("资讯编辑失败[{$e->getMessage()}]");
        }

        return redirect()->route('admin.article.edit', $article);
    }
}
