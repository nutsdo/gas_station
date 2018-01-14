<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

class HomeController extends BaseController
{
    //
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        //获取系统信息
        $php_version = PHP_VERSION;
        $os = PHP_OS;
        $system_info = [
            'php_version'   => $php_version,
            'os'            => $os,
        ];

        return view('dashboard.home.index',compact('system_info'));
    }
}
