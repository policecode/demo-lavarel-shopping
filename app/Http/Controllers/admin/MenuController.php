<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\Menu;
class MenuController extends Controller{
    private $menus;
    public function __construct(){
        $this->menus = new Menu();
    }

    function getMenu() {
        $menus = $this->menus->getAllMenu();
        $data = [
            'title' => 'Danh sách Menu',
            'active' => 'menu',
            'menu' => $menus
        ];
        return view('page.admin.menu.list', $data);
    }

    function getFormAdd() {
        $menus = $this->menus->getAllMenu();
        $data = [
            'title' => 'Thêm mới Menu',
            'active' => 'menu',
            'menus' => $menus
        ];
        return view('page.admin.menu.add', $data);
    }

    function createMenu(Request $request) {
        $rules = [
            'name' => ['required', 'min:4', 'unique:menus,name'],
            'parent_id' => 'required',
            // 'link' => ['required','unique:menus,link'],

        ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => 'Tên sản phẩm không được nhỏ hơn :min ký tự',
            'unique' => ':attribute đã tồn tại',
        ];
        $attributes = [
            'name' => 'Tên Menu',
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            # code...
            $dataResponse = [
                'msg' => 'Vui lòng kiểm tra lại dữ liệu',
                'status' => 'errors',
                'errors' => $validator->errors(),
            ];
        } else {
            $status = $this->menus->insertMenu($request->all());
            if ($status = true) {
                $dataResponse = [
                    'msg' => 'Thêm tag Menu thành công',
                    'status' => 'success',
                ];
            } else {
                $dataResponse = [
                    'msg' => 'Hệ thống đang gặp sự cố, vui lòng thử lại sau',
                    'status' => 'errors',
                ];
            }
        }
        $respone = response()
        ->json($dataResponse)
        ->header('Content-Type', 'application/json');
        return $respone;
    }

    function getFormUpdate($id) {
        $menu = $this->menus->getFirstMenu($id);
        $listMenu = $this->menus->getAllMenu();
        $data = [
            'title' => 'Cập nhật Menu',
            'active' => 'menu',
            'menu' => $menu,
            'listMenu' => $listMenu
        ];
        return view('page.admin.menu.update', $data);
    }

    function updateCategory(Request $request) {
        $rules = [
            'name' => ['required', 'min:4', 'unique:menus,name,'.$request->id],
            'parent_id' => 'required',

        ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => 'Tên sản phẩm không được nhỏ hơn :min ký tự',
            'unique' => ':attribute đã tồn tại',
        ];
        $attributes = [
            'name' => 'Tên Menu',
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            # code...
            $dataResponse = [
                'msg' => 'Vui lòng kiểm tra lại dữ liệu',
                'status' => 'errors',
                'errors' => $validator->errors(),
            ];
        } else {
           
            $status = $this->menus->updateMenu($request->all());
            if ($status = true) {
                $dataResponse = [
                    'msg' => 'Cập nhật thông tin menu thành công',
                    'status' => 'success',
                ];
            } else {
                $dataResponse = [
                    'msg' => 'Hệ thống đang gặp sự cố, vui lòng thử lại sau',
                    'status' => 'errors',
                ];
            }
        }
        $respone = response()
        ->json($dataResponse)
        ->header('Content-Type', 'application/json');
        return $respone;
    }

    function deleteMenu($id) {
        $deleteStatus = $this->menus->deleteMenu($id);
        if ($deleteStatus) {
            $mess = 'success';
        } else {
            $mess = 'error';
        }
        return back()->with('statusDelete', $mess);
    }
}
