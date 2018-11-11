<?php

namespace App\Http\Controllers;

use App\Models\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    public function list()
    {
        $id = Auth::id();
        $products = Wish::find($id)->products();

        dd($products);
        return view('wish.list');
    }
}
