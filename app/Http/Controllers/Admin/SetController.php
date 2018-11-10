<?php

/**
 * 设置
 */

namespace App\Http\Controllers\Admin;

use App\Set;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Krucas\Notification\Facades\Notification;

class SetController extends Controller
{
    /**
     * @action edit
     * @actionName 编辑设置
     */
    public function edit($id)
    {
        $set = Set::findOrFail($id);

        return view('admin.set.edit', compact('set'));
    }

    /**
     * @action update
     * @actionName 修改设置
     */
    public function update(Request $request, $id)
    {
        $set = Set::findOrFail($id);

        try {
            DB::beginTransaction();

            $fields = ['content_1', 'content_2', 'content_3', 'content_4'];
            foreach ($fields as $field) {
                if ($request->has($field)) {
                    $set->$field = $request->input($field);
                }
            }
            $set->save();

            DB::commit();
            Notification::success('设置编辑成功');

        } catch (\Exception $e) {
            DB::rollBack();
            Notification::error("设置编辑失败[{$e->getMessage()}]");
        }

        return redirect()->route('admin.set.edit', $set);
    }
}