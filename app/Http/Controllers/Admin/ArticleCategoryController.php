<?php

namespace App\Http\Controllers\Admin;

use App\ArticleCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Krucas\Notification\Facades\Notification;

class ArticleCategoryController extends Controller
{
    /**
     * @action index
     * @actionName 资讯分类列表
     */
    public function index()
    {
        return view('admin.article.category.index');
    }

    /**
     * @action create
     * @actionName 创建资讯分类
     */
    public function create()
    {
        return view('admin.article.category.create');
    }

    /**
     * @action store
     * @actionName  添加资讯分类
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'unique:article_categories'],
            'slug' => ['required', 'unique:article_categories'],
        ]);

        try {
            DB::beginTransaction();

            $category = new ArticleCategory;

            $fields = ['name', 'slug', 'content', 'sort'];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    $category->$field = $request->input($field);
                }
            }
            $category->save();


            DB::commit();
            Notification::success('分类创建成功');
            $request->session()->flash('script', "MA_menuRename('module_create-category', 'module_edit-category-$category->id', '编辑分类')");

            return redirect()->route('admin.article-category.edit', $category);
        } catch (\Exception $e) {
            DB::rollBack();
            Notification::error("分类创建失败[{$e->getMessage()}]");
            return redirect()->route('admin.article-category.create');
        }
    }

    /**
     * @action edit
     * @actionName  编辑资讯分类
     */
    public function edit($id)
    {
        $category = ArticleCategory::findOrFail($id);

        return view('admin.article.category.edit', compact('category'));
    }

    /**
     * @action update
     * @actionName  修改资讯分类
     */
    public function update(Request $request, $id)
    {
        $category = ArticleCategory::findOrFail($id);

        $this->validate($request, [
            'name' => ['required', Rule::unique('article_categories')->ignore($category->id)],
            'slug' => ['required', Rule::unique('article_categories')->ignore($category->id)]
        ]);

        try {
            DB::beginTransaction();

            $fields = ['name', 'slug', 'content', 'sort'];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    $category->$field = $request->input($field);
                }
            }

            $category->save();

            DB::commit();
            Notification::success('分类编辑成功');

        } catch (\Exception $e) {
            DB::rollBack();
            Notification::error("分类编辑失败[{$e->getMessage()}]");
        }

        return redirect()->route('admin.article-category.edit', $category);
    }
}
