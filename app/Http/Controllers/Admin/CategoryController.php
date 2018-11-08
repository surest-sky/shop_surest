<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Services\CommonService;
use App\Exceptions\ModelException;

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
        $category = null;
        $id = $request->id ?? null;
        if( $id ) {
            $category = Category::find($id);
        }
        return view('admin.category.add_edit',compact('category','id'));

    }

    // 删除用户
    public function delete(Request $request)
    {
        $id = $request->id;
        if ($id) {
            if ($categroy = Category::find($id)) {
                $categroy->delete();
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
    public function update(Request $request)
    {
        $id = $request->id;
        try {
            \DB::BeginTransaction();
            Category::where('id', $id)->update([
                'name' => $request->name
            ]);
            \DB::commit();
            return response()->view('admin.error.title', ['msg' => '更新成功,请刷新']);
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new ModelException([
                'message' => '创建用户出现错误 : ' . $e->getMessage()
            ]);
            return response()->view('admin.error.title', ['msg' => '创建失败,系统错误']);
        }

        return response()->view('admin.error.title', ['msg' => '编辑成功,请刷新']);
    }

    public function create(CategoryCreateRequest $request)
    {
        try {
            \DB::BeginTransaction();
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            session()->flash('status','添加成功');
            \DB::commit();
            return redirect()->back();
        }catch (\Exception $e){
            \DB::rollBack();
            throw new ModelException([
                'message' => '创建分类出现错误 : '. $e->getMessage()
            ]);
            return response()->view('admin.error.title',['msg'=>'添加失败,系统错误']);
        }
    }
}
