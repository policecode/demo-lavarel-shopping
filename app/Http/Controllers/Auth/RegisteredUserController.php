<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8', Rules\Password::defaults()],
            'password_confirmation' => ['same:password']
        ],[
            'required' => ':attribute bắt buộc phải nhập',
            'string' => ':attribute phải là ký tự',
            'max' => ':attribute không được lớn hơn :max ký tự',
            'min' => ':attribute không được ít hơn :min ký tự',
            'email' => ':attribute không đúng định dạng email',
            'unique' => ':attribute đã được sử dụng',
            'same' => 'Mật khẩu nhập lại không chính xác'
        ], [
            'name' => 'Họ tên',
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
            'password_confirmation' => 'Nhập lại mật khẩu'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(RouteServiceProvider::ADMIN);
    }
}
