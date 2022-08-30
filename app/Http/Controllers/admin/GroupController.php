<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Group;
use App\Models\Module;

class GroupController extends Controller
{
    public function index() {
        $lists = Group::all();
        $data = [
            'title' => 'Danh sách nhóm',
            'active' => 'groups',
            'lists' => $lists
        ];
        return view('page.admin.groups.list', $data);
    }

    public function add() {

        $data = [
            'title' => 'Danh sách nhóm',
            'active' => 'groups',
        ];
        return view('page.admin.groups.add', $data);
    }

    public function create(Request $request) {
       $rules = [
        'name' => ['required', 'min:5', 'unique:groups,name'],
       ];
       $message = [
        'required' => ':attribute không được để trống',
        'min' => ':attribute không được ít hơn :min ký tự',
        'unique' => ':attribute đã được sử dụng'
       ];
       $attributes = [
        'name' => 'Tên nhóm'
       ];
       $request->validate($rules, $message, $attributes);

       try {
        $group = new Group();
        $group->name = $request->name;
        $group->user_id = Auth::user()->id;
        $group->save();
         return redirect()->route('admin.groups.index')->with('msg', 'Tạo nhóm mới thành công');
       } catch (\Throwable $th) {
        dd($th);
       }
    }

    public function edit(Group $group) {
        $data = [
            'title' => 'Cập nhật nhóm',
            'active' => 'groups',
            'group' => $group,
        ];
        return view('page.admin.groups.update', $data);
    }

    public function update(Group $group, Request $request) {
        $rules = [
            'name' => ['required', 'min:5', 'unique:groups,name,'.$group->id],
           ];
           $message = [
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được ít hơn :min ký tự',
            'unique' => ':attribute đã được sử dụng'
           ];
           $attributes = [
            'name' => 'Tên nhóm'
           ];
           $request->validate($rules, $message, $attributes);
           try {
                $group->name = $request->name;
                $group->save();
                return back()->with('msg', 'Cập nhật nhóm thành công');
           } catch (\Throwable $th) {
            dd($th);
           }

    }

    public function delete(Group $group) {
        try {
            Group::destroy($group->id);
            return back()->with('msg', 'Xóa nhóm thành công');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function permission(Group $group) {
        $module = Module::all();
        $permission = json_decode($group->permission, true);
        $data = [
            'title' => 'Phân quyền',
            'active' => 'groups',
            'group' => $group,
            'module' => $module,
            'permission' => $permission
        ];
        return view('page.admin.groups.permission', $data);
    }

    public function updatePermission(Group $group, Request $request){
        $dataUpdate = [];
        foreach ($request->all() as $key => $value) {
            if ($key != '_token') {
                $dataUpdate[$key] = $value;
            }
        }

        $group->permission = json_encode($dataUpdate);
        $group->save();
        return back()->with('msg', 'Phân quyền thành công');
    }
}
