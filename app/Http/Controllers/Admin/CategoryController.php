<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryCreateRequest;

class CategoryController extends Controller
{
    // 渲染用户视图
    public function list()
    {
        $categories = Category::getCategoryAll();
        return view('admin.category.list', compact('categories'));
    }

    // 添加用户
    public function addOrEdit(Request $request)
    {
        $user = null;
        $id = $request->id ?? null;
        if( $id ) {
            $user = User::find($id);
        }
        return view('admin.users.add_edit',compact('user','id'));

    }

    // 删除用户
    public function delete(Request $request)
    {
        $id = $request->id;
        if ($id) {
            if ($user = User::find($id)) {
                $user->delete();
                return response()->json([
                    'message' => '删除成功'
                ], 200);
            }
        }

        return response()->json([
            'message' => '未找到'
        ], 404);

    }

//    // 处理用户添加更新操作
//    public function update(UserUpdateRequest $request)
//    {
//        $id = $request->id;
//        try{
//            \DB::BeginTransaction();
//            $params = CommonService::userSetParams($request);
//            User::where('id',$id)->update($params);
//            \DB::commit();
//
//            return response()->view('admin.error.title',['msg'=>'添加成功,请刷新']);
//        }catch (\Exception $e){
//            \DB::rollBack();
//            throw new ModelException([
//                'message' => '创建用户出现错误 : '. $e->getMessage()
//            ]);
//            return response()->view('admin.error.title',['msg'=>'创建失败,系统错误']);
//        }
//
//        return response()->view('admin.error.title',['msg'=>'编辑成功,请刷新']);
//    }
//
//
    public function create(CategoryCreateRequest $request)
    {
        try {
            \DB::BeginTransaction();
            $params = CommonService::userSetParams($request);
            User::create($params);
            \DB::commit();
            return response()->view('admin.error.title',['msg'=>'添加成功,请刷新']);
        }catch (\Exception $e){
            \DB::rollBack();
            throw new ModelException([
                'message' => '创建用户出现错误 : '. $e->getMessage()
            ]);
            return response()->view('admin.error.title',['msg'=>'添加失败,系统错误']);
        }
    }
//
//
//    public static function isFieldExit($phone,$field)
//    {
//        if( User::where($field,$phone)->count() ) {
//            return false;
//        }
//        return true;
//    }
}
