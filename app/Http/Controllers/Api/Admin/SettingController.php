<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\SettingHomeRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    private $setting;
    public function __construct() {
        $this->setting = new Setting();
    }
    public function index() {
        return [
            'status' => 'success',
            'setting' => Setting::all()
        ];
    }

    public function updateHomePage(Request $request){
        try {
            $count = $this->setting->updateSetting($request->all());
            return [
                'status' => 'success',
                'count' => $count
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 'errors',
            ];
        }
    }
}
