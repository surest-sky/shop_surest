<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Notifications\SubsriberToMail;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $email = $request->email;

        if( !$email || !preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/',$email) ) {
            return response()->json([
                'msg' => '请正确输入邮箱地址'
            ],401);
        }

        if( $emailMdel = Subscriber::where('email',$email)->first() ) {
            return response()->json([
                'msg' => '您已经订阅了'
            ],401);
        }

        $emailMdel = new Subscriber();
        $emailMdel->email = $email;
        $emailMdel->save();

        try{
            $emailMdel->notify( new SubsriberToMail());
        }catch (\Exception $e) {
            return response()->json([
                'msg' => '您的邮箱地址我们无法到达哦'
            ],404);
        }

    }

}
