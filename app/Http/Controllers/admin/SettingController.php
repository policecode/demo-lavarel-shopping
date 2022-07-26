<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SettingHomeRequest;
use App\Models\Setting;
class SettingController extends Controller
{
    private $setting;
    public function __construct() {
        $this->setting = new Setting();
    }
    public function getHomeSettings() {
        $data = [
            'title' => 'Settings',
            'active' => 'settings',
        ];
        return view('page.admin.settings.list', $data);
    }

    public function getFormUpdateHome(Request $request) {
        $sessionData = [];
        if ($request->session()->has('DBsuccess')) {
            $sessionData['DBsuccess'] = $request->session()->pull('DBsuccess');
        }
        if ($request->session()->has('DBerror')) {
            $sessionData['DBerror'] = $request->session()->pull('DBerror');
        }
        $data = [
            'title' => 'Cập nhật trang home',
            'active' => 'settings',
            'sessionData' => $sessionData,

        ];
        return view('page.admin.settings.updateHome', $data);
    }

    public function updateHomePage(SettingHomeRequest $request){
        try {
            $count = $this->setting->updateSetting($request->all());
            $request->session()->put('DBsuccess', 'Cập nhật thành công '.$count.' bản ghi');
        } catch (\Throwable $th) {
            $request->session()->put('DBerror', 'Lỗi cơ sở dữ liệu liên hệ DEV để được khắc phục');
        }
        return back();
    }
}
