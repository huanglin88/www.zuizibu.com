<?php

namespace App\Http\Controllers\Admin;

use App\Rules\Mobile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Krucas\Notification\Facades\Notification;

class UserController extends Controller
{
    /**
     * @action index
     * @actionName 用户列表
     */
    public function index()
    {
        return view('admin.user.index');
    }

    /**
     * @action create
     * @actionName 创建用户
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * @action store
     * @actionName 添加用户
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'mobile' => ['required', new Mobile, 'unique:users'],
            'password' => ['required'],
        ]);

        try {
            DB::beginTransaction();

            $user = new User;
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
            $user->save();

            DB::commit();
            Notification::success('用户创建成功');

            return redirect()->route('admin.user.edit', $user);
        } catch (\Exception $e) {
            DB::rollBack();
            Notification::error("用户创建失败[{$e->getMessage()}]");
            return redirect()->route('admin.user.create');
        }
    }

    /**
     * @action edit
     * @actionName 编辑用户
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    /**
     * @action update
     * @actionName 修改用户
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'mobile' => ['required', new Mobile, Rule::unique('users')->ignore($user->id)],
        ]);

        try {
            DB::beginTransaction();

            $user->mobile = $request->mobile;

            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            DB::commit();
            Notification::success('用户编辑成功');

        } catch (\Exception $e) {
            DB::rollBack();
            Notification::error("用户编辑失败[{$e->getMessage()}]");
        }

        return redirect()->route('admin.user.edit', $user);
    }

}