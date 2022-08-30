<?php

namespace App\Http\Controllers\Api\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    public function login(Request $request){
        $rule = [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required','max:255', 'min:8', Rules\Password::defaults()],
        ];
        $message = [
            'required' => ':attribute bắt buộc phải nhập',
            'string' => ':attribute phải là ký tự',
            'max' => ':attribute không được lớn hơn :max ký tự',
            'min' => ':attribute không được ít hơn :min ký tự',
            'email' => ':attribute không đúng định dạng email',
            'unique' => ':attribute đã được sử dụng',
        ];
        $attribute = [
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
        ];
        $validation = Validator::make($request->all(), $rule, $message, $attribute);
        if ($validation->fails()) {
            return [
                'status' => 'errorsRegister',
                'errors' => $validation->errors(),
               ];
        } else {
            $checkLogin = Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ]);
            if ($checkLogin) {
                $user = Auth::user();
                $token = $user->createToken('auth-token')->plainTextToken;
                return [
                    'status' => 200,
                    'token' => $token
                ];
            } else {
                return [
                    'status' => 401,
                    'title' => 'Thông tin đăng nhập không chính xác'
                ];
            }
        }
    }

    public function visit() {
        return 'Success';
    }

    public function deleteToken(Request $request) {
        $user = Auth::user();
        // return $user->currentAccessToken();
        return $user->tokens()->delete();
    }
}
