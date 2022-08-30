<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function __construct(){

    }

    public function index() {
        // $lists = User::where('group_id', '!==', 'null')->get();
        $lists = User::all();

        $data = [
            'title' => 'Danh sách tài khoản',
            'active' => 'user',
            'lists' => $lists
        ];
        return view('page.admin.users.list', $data);
    }

    public function add() {
        $groups = Group::all();
        $data = [
            'title' => 'Danh mục sản phẩm',
            'active' => 'user',
            'groups' => $groups
        ];
        return view('page.admin.users.add', $data);
    }
}
