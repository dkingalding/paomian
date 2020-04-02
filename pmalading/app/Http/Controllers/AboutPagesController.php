<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutPagesController extends Controller
{
    //
    public function home()
        {
            return view('about_pages/home');
        }

    public function about()
    {
        return '说明页面，操作说明';
    }

    public function contactMe()
    {
        return '我的联系方式';
    }

}
