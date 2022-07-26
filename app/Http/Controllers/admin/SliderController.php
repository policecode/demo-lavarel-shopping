<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\Slider;
class SliderController extends Controller
{
    private $sliders;
    public function __construct(){
        $this->sliders = new Slider();
    }

    function getSlider(Request $request) {
        $sessionData = [];
        if ($request->session()->has('DBsuccess')) {
            $sessionData['DBsuccess'] = $request->session()->pull('DBsuccess');
        }
        if ($request->session()->has('DBerror')) {
            $sessionData['DBerror'] = $request->session()->pull('DBerror');
        }
        $allSlider = $this->sliders->getAll();

        $data = [
            'title' => 'Slider',
            'active' => 'slider',
            'sessionData' => $sessionData,
            'allSlider' => $allSlider
        ];
        return view('page.admin.slider.list', $data);
    }

    function getFormAdd() {
        $data = [
            'title' => 'Thêm Slider',
            'active' => 'slider',
          
        ];
        return view('page.admin.slider.add', $data);
    }

    function createSlider(Request $request) {
        $rules = [
            'name' => ['required', 'min:10', 'unique:sliders,name'],
            'image_path' => ['required'],
            'description' => ['required']
        ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'unique' => ':attribute đã tồn tại',
        ];
        $attributes = [
            'name' => 'Tên slider',
            'image_path' => 'Link ảnh slider',
            'description' => 'Nội dung mô tả slider'
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            $validator->validate();
        } else {
            try {
                $status = $this->sliders->create($request->all());
                if ($status) {
                    $request->session()->put('DBsuccess', 'Thêm slider thành công');
                }
            } catch (\Throwable $th) {
                $request->session()->put('DBerror', 'Lỗi cơ sở dữ liệu liên hệ DEV để được khắc phục');
            }
        }
        return redirect()->route('admin.slider.list');
    }

    function getFormUpdate(Request $request, $id) {
        $sessionData = [];
        if ($request->session()->has('DBsuccess')) {
            $sessionData['DBsuccess'] = $request->session()->pull('DBsuccess');
        }
        if ($request->session()->has('DBerror')) {
            $sessionData['DBerror'] = $request->session()->pull('DBerror');
        }
        $firstSlider = $this->sliders->getId($id);
        if (empty($firstSlider)) {
            $request->session()->put('DBerror', 'Dữ liệu không tồn tại trong hệ thống');
            return redirect()->route('admin.slider.list');
        } 
        $data = [
            'title' => 'Update Slider',
            'active' => 'slider',
            'firstSlider' => $firstSlider,
            'sessionData' => $sessionData
        ];
        return view('page.admin.slider.update', $data);
    }

    function updateSlider(Request $request) {
        $rules = [
            'name' => ['required', 'min:10', Rule::unique('sliders', 'name')->ignore($request->id, 'id')],
            'image_path' => ['required'],
            'description' => ['required']
        ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'unique' => ':attribute đã tồn tại',
            'image' => 'Không đúng định dạng '
        ];
        $attributes = [
            'name' => 'Tên slider',
            'image_path' => 'Link ảnh slider',
            'description' => 'Nội dung mô tả slider'
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            $validator->validate();
        } else {
            try {
                $status = $this->sliders->updateOne($request->all());
                if ($status) {
                    $request->session()->put('DBsuccess', 'Cập nhật slider thành công');
                }
            } catch (\Throwable $th) {
                $request->session()->put('DBerror', 'Lỗi cơ sở dữ liệu liên hệ DEV để được khắc phục');
            }
        }
        return back();
    }

    function deleteSlider(Request $request) {
        try {
            $status = $this->sliders->deleteId($request->id);
            if ($status) {
                $request->session()->put('DBsuccess', 'Xóa slider thành công');
            }
        } catch (\Throwable $th) {
            $request->session()->put('DBerror', 'Lỗi cơ sở dữ liệu liên hệ DEV để được khắc phục');
        }
        return back();
    }
}
