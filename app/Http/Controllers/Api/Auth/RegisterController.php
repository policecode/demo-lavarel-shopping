<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{
    public function create(Request $request)
    {
        $rule = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8', Rules\Password::defaults()],
            'password_confirmation' => ['same:password']
        ];
        $message = [
            'required' => ':attribute bắt buộc phải nhập',
            'string' => ':attribute phải là ký tự',
            'max' => ':attribute không được lớn hơn :max ký tự',
            'min' => ':attribute không được ít hơn :min ký tự',
            'email' => ':attribute không đúng định dạng email',
            'unique' => ':attribute đã được sử dụng',
            'same' => 'Mật khẩu nhập lại không chính xác'
        ];
        $attribute = [
            'name' => 'Họ tên',
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Nhập lại mật khẩu'
        ];
        $validation = Validator::make($request->all(), $rule, $message, $attribute);

        if ($validation->fails()) {
           return [
            'status' => 'errorsRegister',
            'errors' => $validation->errors(),
           ];
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            event(new Registered($user));
    
            Auth::login($user);
    
            return response()->json(['status' => 'success']);
        }
    }
}
