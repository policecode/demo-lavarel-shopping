<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHome()
    {
        $data = [
            'title' => 'Trang quản trị',
            'active' => 'home',
        ];
        return view('page.admin.home', $data);
    }
}
