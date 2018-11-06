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
use App\Http\Requests\Admin\RoleRequest;
use App\Exceptions\SysException;

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

    public function roleEditOrAdd(Role $role,Request $request)
    {
        $id = $request->id;
        $permissions = Permission::all();
        // 当id 存在的时候表明要编辑更新
        if( $id && $role = Role::findById($id) ){
            $role_permissions = $role->permissions;
            $ids = $permissions->intersect($role_permissions)->pluck('id')->toArray(); // 两者交集
            return view('admin.admins.role_edit',compact('permissions','role','ids'));
        }
            return view('admin.admins.role_edit',compact('permissions'));
    }

    public function roleStore(RoleRequest $request)
    {
        $id = $request->id;

        // id存在的时候表明更新
        if( $id ) {
            try{
                \DB::BeginTransaction();
                $role = Role::findById($id);
                $p_id = $role->permissions()->pluck('id')->all(); // 原表中的权限
                $ids = self::setIds($request->ids,$role->id);
                \DB::table(config('permission.table_names.role_has_permissions'))->whereIn('role_id',$p_id)->delete();
                \DB::table(config('permission.table_names.role_has_permissions'))->insert($ids);
                $role->name = $request->name;
                $role->description = $request->description;
                $role->save();
                \DB::commit();

            }catch (\Exception $e){
                \DB::rollBack();
                throw new SysException([
                    'message' => '更新角色出现错误 : '. $e->getMessage()
                ]);
            }
        }

        // 添加操作
        $name = $request->name;
        $description = $request->description;
        $role = Role::create(compact('name','description'));

        $ids = self::setIds($request->ids,$role->id);
        \DB::table(config('permission.table_names.role_has_permissions'))->insert($ids);
        session()->flash('status','添加成功');

        return response()->view('admin.error.title',['msg'=>'添加成功,请刷新']);
    }

    /**
     * 组装存入中间表的数据
     * @param $r_id
     */
    public static function setIds($ids,$r_id)
    {
        $arr = [];
        foreach ($ids as $id){
            $temp['permission_id'] = $id;
            $temp['role_id'] = $r_id;
            array_push($arr,$temp);
            unset($temp);
        }
        return $arr;
    }

    public function roleDelete(Role $role,Request $request)
    {
        $id = $request->id;
        if( $id ){
            if( $role = Role::find($id) ){
                $role->delete();
                return response()->json([
                    'message' => '删除成功'
                ],200);
            }
        }

        return response()->json([
            'message' => '未找到'
        ],404);
    }


    /***--------权限管理模块------------*/
    public function PermissionEditOrAdd()
    {
        return view('admin.admins.permission_edit');
    }

    public function PermissionStore(PermissionRequest $request)
    {
        $id = $request->id;

        // 编辑操作
        if( $id ) {
            if( $permission = Permission::find($id) ) {
                $permission->name = $request->name;
                $permission->description = $request->description;
                $permission->route = $request->route;
            }
        }
    }



}