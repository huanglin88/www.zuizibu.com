<?php

namespace App\Http\Controllers\Api\Admin;

use App\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ArticleCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = ArticleCategory::withCount('articles')->orderBy('created_at', 'ASC');

        return DataTables::of($categories)
            ->addColumn('actions', function ($category) {
                return '<a href="' . route('admin.article-category.edit', $category) . '" class="btn btn-xs btn-default" role="button" data-tab=\'' . json_encode(['name' => 'module_edit-category-' . $category->id, 'text' => '编辑分类'], true) . '\'><i class="fa fa-edit"></i> 编辑</a> <button class="btn btn-xs btn-default J_delete" data-id="' . $category->id . '"><i class="fa fa-trash"></i> 删除</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function destroy($id)
    {
        ArticleCategory::destroy($id);
    }
}
