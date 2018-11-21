<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Address;
use App\Http\Requests\AddressRequest;

class MeController extends Controller
{
    public function index()
    {
        $uid = Auth::id();

        $user = User::getUserDetailInfo($uid);

        return view('user.show',compact('user'));
    }

    public function address()
    {
        $uid = Auth::id();
        $addresses = Address::getAddress($uid);

        return view('me.address',compact('addresses'));
    }

    /**
     * 渲染 收货地址编辑页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add_edit(Request $request)
    {
        $id = $request->id;
        if( $id && $address = Address::find($id) ) {
            return view('me.address_edit_add',compact('address'));
        }
        return view('me.address_edit_add');
    }


    /**
     * 创建一个收货地址
     * @param AddressRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(AddressRequest $request)
    {
        $data = Address::setData($request);

        Address::create($data);

        session()->flash('status','添加成功');

        return redirect()->route('me.address');
    }

    /**
     * 更新一个收货地址
     * @param AddressRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(AddressRequest $request)
    {
        $data = Address::setData($request);

        $aId = $request->id;

        if( $address = Address::find($aId) ) {
            $this->authorize('deleteOrUpdate', $address);

            Address::where('id',$aId)->update($data);

            session()->flash('status','更新成功');

            return redirect()->route('me.address');
        }

        session()->flash('error','更新失败，未找到');

        return redirect()->back();

    }

    /**
     * 删除一个收货地址
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Request $request)
    {
        $aId = $request->id;
        $uid = Auth::id();

        if( $address = Address::where('user_id',$uid)->where('id',$aId)->first() ) {

            $address->delete();

            return response()->json([
                'msg' => '删除成功',
                'status' => 200,
                'code' => 1000
            ],200);
        }

        return response()->json([
            'msg' => '未找到或者其他原因',
            'status' => 200,
            'code' => 1000
        ],200);
    }



}
