<?php

/**
 * 友情链接
 */

namespace App\Http\Controllers\Admin;


use App\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Krucas\Notification\Facades\Notification;

class LinkController extends Controller
{
    /**
     * @action index
     * @actionName 友情链接列表
     */
    public function index()
    {
        return view('admin.link.index');
    }

    /**
     * @action create
     * @actionName 创建友情链接
     */
    public function create()
    {
        return view('admin.link.create');
    }

    /**
     * @action store
     * @actionName 添加友情链接
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'url' => ['required'],
        ], [
            'name.required' => '名称不能为空',
            'url.required' => 'URL不能为空',
        ]);

        try {
            DB::beginTransaction();

            $link = new Link();
            $fields = ['name', 'url', 'sort'];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    $link->$field = $request->input($field);
                }
            }
            $link->save();

            DB::commit();
            Notification::success('友情链接创建成功');

            return redirect()->route('admin.link.edit', $link);
        } catch (\Exception $e) {
            DB::rollBack();
            Notification::error("友情链接创建失败[{$e->getMessage()}]");
            return redirect()->route('admin.link.create');
        }
    }

    /**
     * @action edit
     * @actionName 编辑友情链接
     */
    public function edit($id)
    {
        $link = Link::findOrFail($id);

        return view('admin.link.edit', compact('link'));
    }

    /**
     * @action update
     * @actionName 修改友情链接
     */
    public function update(Request $request, $id)
    {
        $link = Link::findOrFail($id);

        $this->validate($request, [
            'name' => ['required'],
            'url' => ['required'],
        ], [
            'name.required' => '名称不能为空',
            'url.required' => 'URL不能为空',
        ]);


        try {
            DB::beginTransaction();

            $fields = ['name', 'url', 'sort'];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    $link->$field = $request->input($field);
                }
            }
            $link->save();

            DB::commit();
            Notification::success('友情链接编辑成功');

        } catch (\Exception $e) {
            DB::rollBack();
            Notification::error("友情链接编辑失败[{$e->getMessage()}]");
        }

        return redirect()->route('admin.link.edit', $link);
    }
}