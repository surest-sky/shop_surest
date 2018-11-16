<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ExpressImport;
use Maatwebsite\Excel\Facades\Excel;

class ExpressController extends Controller
{
    public function import()
    {
        $filePath = '/123.xlsx';


        Excel::import(new ExpressImport, $filePath);

        return 'good';
    }
}
