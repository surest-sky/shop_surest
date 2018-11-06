<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/5
 * Time: 23:04
 */

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    public function list()
    {
        $users = Admin::getByUserAll(true);
        $usersAll = Admin::getByUserAll(false);
        return view('admin.admins.list',compact('users','usersAll'));
    }

    public function role()
    {
        // 获取所有的权限
        $roles = Role::with('permissions')->get();

        return view('admin.admins.role',compact('roles'));
    }

    public function permission()
    {
        // 获取所有的权限
        $permissions = Admin::getPermissionAll();

        return view('admin.admins.permission',compact('permissions'));
    }

    public function roleEdit(Role $role,Request $request)
    {
        $id = $request->id;
        // 当id 存在的时候表明要编辑更新
        if( $role = Role::findById($id) ){
            $role_permissions = $role->permissions;
            $permissions = Permission::all();
            $ids = $permissions->intersect($role_permissions)->pluck('id')->toArray(); // 两者交集
            return view('admin.admins.role_edit',compact('permissions','role','ids'));
        }
    }

    public function roleUpdat(Request $request)
    {

    }

}