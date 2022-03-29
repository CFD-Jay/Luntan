<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //改变网站主页
    public function root()
    {
        return view('pages.root');
    }
}
