<?php

namespace App\Http\Controllers\Api\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC');

        return DataTables::of($users)
            ->addColumn('actions', function ($user) {
                return '<a href="' . route('admin.user.edit', $user) . '" class="btn btn-xs btn-default" role="button" data-tab=\'' . json_encode(['name' => 'module_edit-user-' . $user->id, 'text' => '编辑用户'], true) . '\'><i class="fa fa-edit"></i> 编辑</a> <button class="btn btn-xs btn-default J_delete" data-id="' . $user->id . '"><i class="fa fa-trash"></i> 删除</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}
