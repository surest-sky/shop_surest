<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ExpressImport;
use Maatwebsite\Excel\Facades\Excel;

class ExpressController extends Controller
{
    /**
     * 导入快递公司信息
     * @return string
     */
    public function import()
    {
        $filePath = '/123.xlsx';


        Excel::import(new ExpressImport, $filePath);

        return 'good';
    }
}
