<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/5
 * Time: 23:04
 */

namespace App\Http\Controllers\Admin;

use App\Exceptions\SysException;
use App\Http\Requests\Admin\PermissionRequest;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminsRequest;
use App\Services\CommonService;

class AdminController extends BaseController
{

    public function admins()
    {
        $users = Admin::getByUserAll(true);
        $user = \Auth::guard('admin')->user();

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

    public function roleEditOrAdd(Request $request)
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

    /**
     * 角色管理
     * @param RoleRequest $request
     * @return \Illuminate\Http\Response
     * @throws SysException
     */
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
                \DB::table(config('permission.table_names.role_has_permissions'))->where('role_id',$id)->delete();
                \DB::table(config('permission.table_names.role_has_permissions'))->insert($ids);
                $role->name = $request->name;
                $role->description = $request->description;
                $role->save();
                \DB::commit();
                return response()->view('admin.error.title',['msg'=>'更新成功,请刷新']);
            }catch (\Exception $e){
                \DB::rollBack();
                dd($e->getMessage());
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
    public function permissionEditOrAdd(Request $request)
    {
        $id = $request->id;

        $list = getRouteList();

        if( $id ) {
            if( $permission = Permission::find($id) ){
                return view('admin.admins.permission_edit',compact('permission','list'));
            }
        }

        return view('admin.admins.permission_edit',compact('list'));
    }

    public function permissionStore(PermissionRequest $request)
    {
        $id = $request->id;
        try{
            \DB::BeginTransaction();
            $params = [
                'name' => $request->name,
                'description' => $request->description ?? '',
                'route' => $request->route,
            ];
            // 编辑操作
            if( $id ) {
                if( $permission = Permission::find($id) ) {
                    Permission::where('id',$permission->id)
                        ->update($params);
                    \DB::commit();
                    return response()->view('admin.error.title',['msg'=>'编辑成功,请刷新']);
                }
            }
            Permission::create($params);
            \DB::commit();
            return response()->view('admin.error.title',['msg'=>'添加成功,请刷新']);
        }catch (\Exception $e){
            \DB::rollBack();
            throw new SysException([
                'message' => '添加权限出现错误 : '. $e->getMessage()
            ]);
        }
    }

    public function permissionDelete(Request $request)
    {
        $id = $request->id;
        if ($id) {
            if ($permission = Permission::find($id)) {
                $permission->delete();
                return response()->json([
                    'message' => '删除成功'
                ], 200);
            }
        }

        return response()->json([
            'message' => '未找到'
        ], 404);

    }

    /** --------管理员列表管理-------- ***/

    /**
     * 渲染用户编辑添加渲染
     * @param string $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminsEditOrAdd($id='',Request $request)
    {
        $roles = Role::all();

        // 当id 存在的时候表明要编辑更新
        if( $id && $admin = Admin::find($id) ){
            $admin_roles = $admin->getRoleNames()->toArray(); // 当前用户的角色名字

            $roles = Role::query()->select('name','id')->get();

            return view('admin.admins.admin_edit',compact('admin','roles','admin_roles'));
        }

        return view('admin.admins.admin_edit',compact('roles'));
    }

    /**
     * 用户添加删除操作处理
     * @param AdminsRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws SysException
     */
    public function adminsStore(AdminsRequest $request)
    {
        $id = $request->id;
        try{
            \DB::BeginTransaction();
            // 编辑操作
            if( $id ) {
                if( $admin = Admin::find($id) ) {
                    $params = CommonService::setParams($request,$admin);
                    Admin::where('id',$admin->id)
                        ->update($params);
                    // 修改角色
                    $roles = $request->roles;
                    $admin->syncRoles($roles); //所有当前角色将从用户中删除，并由给定
                    \DB::commit();
                    return response()->view('admin.error.title',['msg'=>'编辑成功,请刷新']);
                }
            }

            if( Admin::where('name',$request->name)->count() ) {
                session()->flash('status','用户已经存在');
                return redirect()->back();
            }

            $params = CommonService::setParams($request,false);

            $admin = Admin::create($params);

            $admin->assignRole($request->role);

            \DB::commit();
            return response()->view('admin.error.title',['msg'=>'添加成功,请刷新']);
        }catch (\Exception $e){
            \DB::rollBack();
            throw new SysException([
                'message' => '添加权限出现错误 : '. $e->getMessage()
            ]);
        }
    }

    /**
     * 用户操作
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function adminsDelete(Request $request)
    {
        $id = $request->id;
        if ($id) {
            if ($admin = Admin::find($id)) {
                if( $this->isAdmin($admin) ){
                    return response()->json([
                        'message' => '非法'
                    ], 403);
                }
                $admin->delete();
                return response()->json([
                    'message' => '删除成功'
                ], 200);
            }
        }

        return response()->json([
            'message' => '未找到'
        ], 404);

    }

    /**
     * 用户启用停用操作
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function adminsActived(Request $request)
    {
        $id = $request->id;
        if ($id) {
            if ($admin = Admin::find($id)) {

                if( $this->isAdmin($admin) ){
                    return response()->json([
                        'message' => '非法'
                    ], 403);
                }
                $admin->actived = $request->active;
                $admin->save();
                return response()->json([
                    'message' => '修改成功'
                ], 200);
            }
        }

        return response()->json([
            'message' => '未找到'
        ], 404);

    }

    public function isAdmin($admin)
    {
        if( $admin->name == config('main.admin') ){
            return true;
        }
            return false;
    }

}