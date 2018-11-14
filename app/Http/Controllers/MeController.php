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
        $addresses = Address::with(['addresses'])->where('user_id',$uid)->get();

        return view('me.address',compact('addresses'));
    }

    public function add_edit()
    {
        return view('me.address_edit_add');
    }

    public function create(AddressRequest $request)
    {
        dd($request->all());

        $arr = [
           'name' => $request->name ,
           'address,' => $request->address,
           'phone' => $request->phone,
           'detail' => $request->detail
        ];

        Address::create($arr);

        session()->flash('status','添加成功');

        return redirect()->route('me.address');
    }



}
