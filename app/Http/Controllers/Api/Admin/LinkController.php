<?php

/**
 * 友情链接
 */

namespace App\Http\Controllers\Api\Admin;

use App\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $links = Link::orderBy('created_at', 'DESC');

        if ($request->has('key') && !empty($request->key)) {
            $links->where([
                ['name', 'like', '%' . $request->key . '%', 'or'],
                ['id', '=', $request->key, 'or']
            ]);
        }

        return DataTables::of($links)
            ->addColumn('actions', function ($link) {
                return '<a href="' . route('admin.link.edit', $link) . '" class="btn btn-xs btn-default" role="button" data-tab=\'' . json_encode(['name' => 'module_edit-link-' . $link->id, 'text' => '编辑友情链接'], true) . '\'><i class="fa fa-edit"></i> 编辑</a> <button class="btn btn-xs btn-default J_delete" data-id="' . $link->id . '"><i class="fa fa-trash"></i> 删除</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function destroy($id)
    {
        Link::destroy($id);
    }
}
