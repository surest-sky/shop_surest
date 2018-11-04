<?php

namespace App\Http\Controllers\About;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    // 条款和条件
    public function trems_conditions()
    {
        return view('about.trems_conditions');
    }
}
