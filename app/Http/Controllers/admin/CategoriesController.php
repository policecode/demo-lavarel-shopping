<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\Category;
class CategoriesController extends Controller
{
    private $category;
    public function __construct(){
        $this->category = new Category();
    }
    function getCategory() {
        $listCategory = $this->category->getAllCategory();
        $data = [
            'title' => 'Danh mục sản phẩm',
            'active' => 'categories',
            'listCategory' => $listCategory
        ];
        return view('page.admin.categories.list', $data);
    }

    function getFormAdd() {
        $listCategory = $this->category->getAllCategory();
        $data = [
            'title' => 'Thêm mới danh mục sản phẩm',
            'active' => 'categories',
            'listCategory' => $listCategory
        ];
        return view('page.admin.categories.add', $data);
    }

    function createCategory(Request $request) {
        $rules = [
            'name' => 'required|min:4',
            'parent_id' => 'required',
            'slug' => ['required','unique:categories,slug'],

        ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => 'Tên sản phẩm không được nhỏ hơn :min ký tự',
            'unique' => ':attribute đã tồn tại trong hệ thống',
        ];
        $attributes = [
            'name' => 'Tên sản phẩm',
            'slug' => 'Đường dẫn'
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
           
            $status = $this->category->insertCategory($request->all());
            if ($status = true) {
                $dataResponse = [
                    'msg' => 'Thêm sản phẩm mới thành công',
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
        $category = $this->category->getFirstCategory($id);
        $listCategory = $this->category->getAllCategory();
        $data = [
            'title' => 'Cập nhật danh mục sản phẩm',
            'active' => 'categories',
            'category' => $category,
            'listCategory' => $listCategory
        ];
        return view('page.admin.categories.update', $data);
    }

    function updateCategory(Request $request) {
        $rules = [
            'name' => 'required|min:4',
            'parent_id' => 'required',
            'slug' => ['required','unique:categories,slug, '.$request->id],

        ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => 'Tên sản phẩm không được nhỏ hơn :min ký tự',
            'unique' => ':attribute đã tồn tại trong hệ thống',
        ];
        $attributes = [
            'name' => 'Tên sản phẩm',
            'slug' => 'Đường dẫn'
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
           
            $status = $this->category->updateCategory($request->all());
            if ($status = true) {
                $dataResponse = [
                    'msg' => 'Cập nhật thông tin sản phẩm mới thành công',
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

    function deleteCategory($id) {
        $deleteStatus = $this->category->deleteCategory($id);
        $data = [
            'title' => 'Thực hiện thao tác xóa',
            'active' => 'categories',
        ];
        if ($deleteStatus) {
            $mess = 'success';
        } else {
            $mess = 'error';
        }
        return back()->with('statusDelete', $mess);
    }
}
